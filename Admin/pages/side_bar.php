<aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="index.php">
                          <i class="icon_house_alt"></i>
                          <span>Dashboard</span>
                      </a>
          </li>
          <li class="active">
            <a class="" href="profile.php?user_id=<?php echo $user_obj->getID();?>">
                          <i class="fa fa-user"></i>
                          <span>Profile</span>
                      </a>
          </li>
           <li class="active">
            <a class="" href="category.php">
                          <i class="fa fa-suitcase"></i>
                          <span>Category</span>
                      </a>
          </li>
          <?php 
            $role = $user_obj->getRole();
            if ($role === 'Admin'):
           ?>
           <li class='active'>
            <a class='' href='add_category.php'>
                          <i class='fa fa-folder'></i>
                          <span>Add Category</span>
                      </a>
          </li>
        <?php endif;?>
        <?php 
            $role = $user_obj->getRole();
            if ($role === 'Admin'):
           ?>
           <li class='active'>
            <a class='' href='add_post.php'>
                          <i class='fa fa-globe'></i>
                          <span>Add News</span>
                      </a>
                      
          </li>
        <?php endif;?>
           <?php 
            $role = $user_obj->getRole();
            if ($role === 'Admin'):
           ?>
           <li class='active'>
            <a class='' href='addusers.php'>
                          <i class='fa fa-users'></i>
                          <span>Add Users</span>
                      </a>
                      
          </li>
        <?php endif;?>
           <li class='active'>
            <a class='' href='comments.php'>
                <i class='fa fa-comments'></i>
                <?php 
                  $sql = mysqli_query($connection, "SELECT * FROM comments WHERE status='unapproved'");
                  $num = mysqli_num_rows($sql);
                  if($num > 0){
                    echo "<span>Comments <i class='text-info'>$num</i><sup>new</sup></span>";
                  }else{
                    echo "<span>Comments</span>";
                  }
                ?>
                
            </a>       
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>