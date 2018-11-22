<?php
function nines_taoke_settings_page() {
  ?>
  <div class="wrap">
    <h2>淘宝客插件配置</h2>
    <form method="post" action="options.php">
      <?php settings_fields( 'nines-taoke-settings-group' );?>
      <?php do_settings_sections( 'nines-taoke-settings-group' );?>
      <table class="form-table">
        <tr valign="top">
          <th scope="row">App Key</th>
          <td><input type="text" name="nines_taoke_key" class="regular-text nm-color-picker" value="<?php echo esc_attr( get_option('nines_taoke_key') ); ?>" /></td>
        </tr>

        <tr valign="top">
          <th scope="row">App Secret</th>
          <td><input type="text" name="nines_taoke_secret" class="regular-text nm-color-picker" value="<?php echo esc_attr( get_option('nines_taoke_secret') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
          <th scope="row">Pid</th>
          <td><input type="text" name="nines_taoke_pid" class="regular-text nm-color-picker" value="<?php echo esc_attr( get_option('nines_taoke_pid') ); ?>" /></td>
        </tr>
        <tr valign="top">
          <th scope="row">
            请选择一个需要展示商品的页面
          </th>
          <td>
            <select name="nines_taoke_pagename">
              <?php $config_name = esc_attr( get_option('nines_taoke_pagename') );;
              $pages = get_pages(array('post_type' => 'page','post_status' => 'publish'));
              echo "<option class='level-0' value=''>不选择</option>";
              foreach($pages as $val){
                $selected = ($val->ID == $config_name)? 'selected="selected"' : "";
                $page_title = $val->post_title;
                $page_name = $val->ID;
                echo "<option class='level-0' value='{$page_name}' {$selected}>{$page_title}</option>";
              }
              ?>
            </select>
          </td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>
<?php }?>