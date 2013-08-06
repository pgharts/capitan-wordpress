<h2>Capitan - Cultural District API Connector</h2>

<form action="options.php" method="post">
  <?php settings_fields( 'capitan-settings-group' ); ?>
  <table class="form-table">
    <tbody>
      <tr valign="top">
        <th scope="row">API Domain (i.e. http://trustarts.culturaldistrict.org)</th>
        <td><input name="capitan_domain" type="text" id="capitan_domain" value="<?php echo get_option('capitan_domain'); ?>" class="regular-text" /></td>
      </tr>
      <tr valign="top">
        <th scope="row">API Key</th>
        <td><input name="capitan_api_key" type="text" id="capitan_api_key" value="<?php echo get_option('capitan_api_key'); ?>"" class="regular-text" /></td>
      </tr>
    </tbody>
  </table>
  <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /> </p>
</form>