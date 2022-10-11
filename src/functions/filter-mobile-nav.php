<?php 



function utkchancellor_mobileButton($menu) {
    ?>
    <button class="btn btn-primary btn-mobileNav" type="button" data-bs-toggle="collapse"  data-bs-target="#menu-mainnavigation" aria-expanded="false" aria-controls="collapseExample">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z"></path></svg> <span class="navLabel">Menu</span>
  </button>
   <?php
  return $menu;

}

add_action ('genesis_header', 'utkchancellor_mobileButton');

