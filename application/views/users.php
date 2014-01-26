<?php include('includes/views-config.php'); ?>

            <div class="row">
                <div class="col-sm-12">

                    <div id="add-new-product" class="pull-right boxed">
                        <a class="btn boxed-turquoise bold" href="<?php echo $new_user; ?>"><span>Add New User</span></a>
                    </div>

                    <table class="boxed-table">
                        <thead class="boxed-black">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                                foreach($accounts as $user){
                                    $id = $user['id'];
                                    $username = $user['username'];
                                    $firstname = $user['firstname'];
                                    $lastname = $user['lastname'];
                                    $type = $user['type'];
                                    $date_registered = $user['date_registered'];
                                    
                            ?>
                            <tr>
                                
                                <td><?php echo $id; ?></td>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $firstname; ?></td>
                                <td><?php echo $lastname; ?></td>
                                <td><?php echo $type; ?></td>
                                <td class="options">
                                    <a class="btn btn-blue btn-icon-right btn-arrow-right" href="<?php echo $edit_user . '/' . $id; ?>"><span>View Full Info</span></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div class="tf_pagination style3">
                        <div class="inner">
                            <?php echo $links; ?>
                        </div>
                        
                    </div>


                </div>
            </div>