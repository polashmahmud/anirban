<?php


namespace App\Classes;


class Helper
{
    public static function delete_form($form_url, $id)
    {
        $token = @csrf_token();
        $form = "<form id=\"delete-form-$id\" method=\"post\" action=\"$form_url\" style=\"display: none\">
                    <input type=\"hidden\" name=\"_token\" value=\"$token\">
                    <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                  </form>
                  <span><a class='btn btn-default btn-xs m-r-5' data-toggle=\"tooltip\" data-original-title=\"Delete\" href=\"\" onclick=\"
                  if(confirm('Are you sure, You Want to delete this?'))
                      {
                        event.preventDefault();
                        document.getElementById('delete-form-$id').submit();
                      }
                      else{
                        event.preventDefault();
                      }\" ><i class=\"ti-trash color-danger font-14\"></i></a>";

        return $form;
    }

    public static function status_change($url, $table, $id, $column, $value, $btn_text_one, $btn_text_two, $message)
    {
        $btn_class = $value ? 'btn btn-info btn-xs' : 'btn btn-warning btn-xs';
        $btn_text = $value ? $btn_text_one : $btn_text_two;
        $token = @csrf_token();
        $form = "<form id=\"status-change-$id\" method=\"post\" action=\"$url\" style=\"display: none\">
                    <input type=\"hidden\" name=\"_token\" value=\"$token\">
                    <input type=\"hidden\" name=\"table\" value=\"$table\">
                    <input type=\"hidden\" name=\"id\" value=\"$id\">
                    <input type=\"hidden\" name=\"column\" value=\"$column\">
                    <input type=\"hidden\" name=\"value\" value=\"$value\">
                    <input type=\"hidden\" name=\"message\" value=\"$message\">
                  </form>
                  <span><a class='$btn_class' href=\"\" onclick=\"
                  if(confirm('Are you sure, You Want to Change this?'))
                      {
                        event.preventDefault();
                        document.getElementById('status-change-$id').submit();
                      }
                      else{
                        event.preventDefault();
                      }\" >$btn_text</a>";

        return $form;

    }
}