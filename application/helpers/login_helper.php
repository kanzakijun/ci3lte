<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('user_username')) {
        redirect('auth');
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

/* End of file login_helper.php and path /application/helpers/login_helper.php */