<?php

use App\Models\Post;

beforeEach(function () {
    $this->withoutVite();
});

function feedbackPostData(array $overrides = []): array
{
    return array_merge([
        'title' => 'Article avec message',
        'slug' => 'article-avec-message',
        'body' => 'Contenu assez long pour passer la validation.',
        'is_published' => '1',
    ], $overrides);
}

it('shows a success message after creating a post', function () {
    $this->followingRedirects()
        ->post(route('posts.store'), feedbackPostData())
        ->assertOk()
        ->assertSee('Article créé.')
        ->assertSee('role="status"', false);

    $post = Post::where('slug', 'article-avec-message')->firstOrFail();

    $this->get(route('posts.show', $post))->assertDontSee('Article créé.');
});

it('shows a success message after updating a post', function () {
    $post = Post::factory()->create(['slug' => 'article-a-modifier']);

    $this->followingRedirects()
        ->put(route('posts.update', $post), feedbackPostData([
            'slug' => $post->slug,
            'title' => 'Article mis à jour',
        ]))
        ->assertOk()
        ->assertSee('Article mis à jour.');
});

it('shows a success message after publishing and unpublishing a post', function () {
    $post = Post::factory()->create(['is_published' => false, 'published_at' => null]);

    $this->followingRedirects()
        ->patch(route('posts.publication', $post))
        ->assertOk()
        ->assertSee('Article publié.');

    $this->followingRedirects()
        ->patch(route('posts.publication', $post))
        ->assertOk()
        ->assertSee('Article dépublié.');
});

it('shows a success message after deleting a post', function () {
    $post = Post::factory()->create();

    $this->followingRedirects()
        ->delete(route('posts.destroy', $post))
        ->assertOk()
        ->assertSee('Article supprimé.');
});

it('blocks writes in read-only mode while allowing safe requests', function () {
    config(['site.read_only' => true]);

    $this->get(route('posts.index'))->assertOk();

    $this->post(route('posts.store'), feedbackPostData())->assertStatus(503);

    $this->assertDatabaseMissing('posts', ['slug' => 'article-avec-message']);
});

it('shows the custom page for an unknown post', function () {
    $this->get('/posts/999')
        ->assertNotFound()
        ->assertSee('Article introuvable');
});

it('keeps the standard 404 page for an unknown category', function () {
    $this->get('/posts/categorie/inconnue')
        ->assertNotFound()
        ->assertDontSee('Article introuvable');
});

it('keeps unknown post responses in JSON when JSON is requested', function () {
    $this->getJson('/posts/999')
        ->assertNotFound()
        ->assertJsonStructure(['message']);
});

it('shows the read-only banner only when the site is read-only', function () {
    config(['site.read_only' => false]);

    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('Site en lecture seule');

    config(['site.read_only' => true]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Site en lecture seule');
});

it('shows recent published posts but not drafts on the custom 404 page', function () {
    Post::factory()->published()->create(['title' => 'Article recent publie']);
    Post::factory()->create(['title' => 'Brouillon masque']);

    $this->get('/posts/999')
        ->assertNotFound()
        ->assertSee('Articles récents')
        ->assertSee('Article recent publie')
        ->assertDontSee('Brouillon masque');
});

it('hides the recent posts section when no post is published', function () {
    Post::factory()->create(['title' => 'Brouillon uniquement']);

    $this->get('/posts/999')
        ->assertNotFound()
        ->assertDontSee('Articles récents')
        ->assertDontSee('Brouillon uniquement');
});
