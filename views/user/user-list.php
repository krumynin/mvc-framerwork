<table>
    <tr>
        <td>Id</td>
        <td>Name</td>
        <td>Email</td>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->getId() ?></td>
            <td><?= $user->getName() ?></td>
            <td><?= $user->getEmail() ?></td>
        </tr>
    <?php endforeach; ?>
</table>
