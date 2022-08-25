<h2><?= $title ?></h2>


<table class="table table-dark table-hover mt-20">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Registration date</th>
            <th>Action #1</th>
            <th>Action #2</th>
            <th>Action #3</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($users as $user) : ?>

        <?php  echo "<tr>" .
               "<td>" . $user['id'] . "</td>" .
               "<td>" . $user['name'] . "</td>" .
               "<td>" . $user['email'] . "</td>" .
               "<td>" . $user['username'] . "</td>" .
               "<td>" . $user['register_date'] . "</td>" .
               "<td> <a type='button' class='btn btn-primary' href='#'>Messages</a> </td>" .
               "<td> <a type='button' href='' class='btn btn-success'>Edit</a> </td>" .
               "<td> <a type='button' class='btn btn-danger' data-toggle='modal' data-target='#myModal' href='" . base_url() . "users/delete/" . $user['id'] ."'>Delete</a> </td" .  
               "</tr>"; ?>

    <?php endforeach; ?>

    </tbody>
  </table>


  <!-- modal for deletions -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Are you sure? This acction can't be undone!
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <a type="button" class="btn btn-danger" data-dismiss="modal">yes</a>
                </div>

                </div>
            </div>
        </div>

        <!-- modal to alert admin before delete START-->

<!-- modal to alert admin before delete END -->

  </div>