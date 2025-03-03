<?php
class pagination {
    protected $_config = array(
        'current_page' => 1,        //Số trang hiện tại
        'total_record' => 1,        //Tổng số sản phẩm 
        'total_page' => 1,          //Tổng số trang
        'limit' => 10,              //Giới hạn số sản phẩm trên mỗi trang
        'start' => 0,               //Vị trí bắt đầu lấy dữ liệu của database
        'link_full' => '',          // url cho trang
        'link_first' => '',         // URL cho trang đầu tiên
        'range' => 2,               //Số button hiển thị
        'min' => 0,                 //Giá trị tổi thiểu trong phạm vi trang hiển thị
        'max' => 0                  //Giá trị tối đa trong phạm vi trang hiển thị
    );

    //Lấy giá trị
    function get_config($key) {
        return $this->_config[$key];
    }

    //Khởi tạo phân trang
    function init($config = array()) {
        foreach ($config as $key => $val) {
            if (isset($this->_config[$key])) {
                $this->_config[$key] = $val;
            }
        }

        if ($this->_config['limit'] < 0) {
            $this->_config['limit'] = 0;
        }

        $this->_config['total_page'] = ceil($this->_config['total_record'] / $this->_config['limit']);

        if (!$this->_config['total_page']) {
            $this->_config['total_page'] = 1;
        }

        if ($this->_config['current_page'] < 1) {
            $this->_config['current_page'] = 1;
        }

        if ($this->_config['current_page'] > $this->_config['total_page']) {
            $this->_config['current_page'] = $this->_config['total_page'];
        }

        $this->_config['start'] = ($this->_config['current_page'] - 1) * $this->_config['limit'];

        $middle = ceil($this->_config['range'] / 2);

        if ($this->_config['total_page'] < $this->_config['range']) {
            $this->_config['min'] = 1;
            $this->_config['max'] = $this->_config['total_page'];
        } else {
            $this->_config['min'] = max(1, $this->_config['current_page'] - 1);
            $this->_config['max'] = min($this->_config['total_page'], $this->_config['current_page'] + 1);
        }
        echo "max ".$this->_config['max'] ;
    }

    //Tạo url cho trang
    public function __link($page) {
        if ($page <= 1 && $this->_config['link_first']) {
            return $this->_config['link_first'];
        }
        return str_replace('{page}', $page, $this->_config['link_full']);
    }

    //Vẽ html cho phân trang
    function html() {
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit']) {
            $p = '<ul class="pagination">';

            if ($this->_config['current_page'] > 1) {
                $p .= '<li><a href="'.$this->__link($this->_config['current_page'] - 1).'">&lt;</a></li>';
            }

            for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++) {
                $class = ($i == $this->_config['current_page']) ? 'active' : '';
                $p .= '<li class="'.$class.'"><a href="'.$this->__link($i).'">'.$i.'</a></li>';
            }

            if ($this->_config['current_page'] < $this->_config['total_page']) {
                $p .= '<li><a href="'.$this->__link($this->_config['current_page'] + 1).'">&gt;</a></li>';
            }

            $p .= '</ul>';
        }
        return $p;
    }
}
?>
