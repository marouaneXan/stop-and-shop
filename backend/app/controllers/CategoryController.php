<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
class CategoryController
{
  // Display all categoris
  public function index()
  {
    $all_categories = new Category();
    if ($all_categories->get_all_categories()) {
      echo json_encode($all_categories->get_all_categories());
    } else {
      echo json_encode(array(
        'message' => 'There is no category available for this moment'
      ));
    }
  }
}
