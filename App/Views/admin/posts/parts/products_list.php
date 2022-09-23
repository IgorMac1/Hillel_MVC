<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Content</th>
        <th scope="col">AUTHOR_ID</th>
        <th scope="col">CREATED_AT</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($posts as $post): ?>
        <tr>
            <th scope="row"><?= $post->id ?></th>
            <td><?= $post->title ?></td>
            <td><?= $post->content ?></td>
            <td><?= $post->author_id ?></td>
            <td><?= $post->created_at ?></td>

            <td>
                <a href="<?= url("admin/posts/{$post->id}/edit") ?>" class="btn btn-info">Edit</a>
                <form action="<?= url("admin/posts/{$post->id}/destroy") ?>" method="post">
                    <button class="btn btn-danger">Remove</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>