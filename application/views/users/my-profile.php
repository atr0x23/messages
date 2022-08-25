<h2><?= $title ?></h2>


<table class="table table-dark table-hover mt-20">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Registration date</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($users as $user) : ?>

        <?php  echo "<tr>" .
               "<td>" . $user['id'] . "</td>" .
               "<td>" . $user['name'] . "</td>" .
               "<td>" . $user['email'] . "</td>" .
               "<td>" . $user['username'] . "</td>" .
               "<td>" . $user['register_date'] . 
               "</tr>"; ?>

    <?php endforeach; ?>

    </tbody>
  </table>