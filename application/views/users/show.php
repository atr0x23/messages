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
               "<td> <a type='button' class='btn btn-primary' href='" . base_url() . "messages/mymessages/" . $user['id'] ."'>Messages</a> </td>" .
               "<td> <a type='button' href='" . base_url() . "users/edit-by-admin/" . $user['id'] ."' class='btn btn-success'>Edit</a> </td>" .
               "<td> <a type='button' data-toggle='modal' data-target='#confirm-delete' class='btn btn-danger' data-href='" . base_url() . "users/delete/" . $user['id'] ."'>Delete</a> </td>" .  
               "</tr>"; ?>

    <?php endforeach; ?>

    </tbody>
  </table>


  <!-- modal for deletions -->

        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
            
                <div class="modal-body">
                    <p>You are about to delete this user, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                    <!-- <p class="debug-url"></p> --> <!--for debug the deletion url-->
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>

<!-- modal delete END -->

<!-- the script modal for deletions -->
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>


  </div>