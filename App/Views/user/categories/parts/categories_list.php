<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>


    </tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $category): ?>
        <tr>
            <th scope="row"><?= $category->id ?></th>
            <td><?= $category->title ?></td>
            <td><?= $category->description ?></td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>