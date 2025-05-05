<?php 
  class list_page_admin {
  function drawListPage($min,$max,$current,$total_record,$limit,$link_full,$link_first) {

    $p = '';
    if ($total_record > $limit) {
      $p =  '<span id="list_page">';
        $p .= '<ul >';
        for ($i = $min; $i <= $max; $i++) {
            $class = ($i == $current) ? 'active' : '';
            if( $class == "") $p .= '<li><a href="'.$this->createLink($i,$link_full,$link_first).'">'.$i.'</a></li>';
            else $p .= '<li id="'.$class.'"><a href="'.$this->createLink($i,$link_full,$link_first).'">'.$i.'</a></li>';
            
        }
        $p .= '</ul>';
        $p .= '</span>';
    }
    echo $p;
    // return $p;
  }
  function createLink($index,$link_full,$link_first){
    if ($index <= 1 && $link_first) {
        return $link_first;
    }
    return str_replace('{page}', $index, $link_full);
  }
}
?>