<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/7/15
 * Time: 11:23
 */

namespace Modules\Core\Response;


use Illuminate\Pagination\LengthAwarePaginator;

class PageResult
{
    /**
     * @var integer $total 总数
     */
    public $total;

    /**
     * @var int $page 页数
     */
    public $page;

    /**
     * @var int $limit 条数
     */
    public $limit;

    /**
     * @var 数据
     */
    public $data;

    public function __construct(LengthAwarePaginator $lengthAwarePaginator, $transformers = null)
    {
        $this->total = $lengthAwarePaginator->total();
        $this->page  = $lengthAwarePaginator->currentPage();
        $this->limit = $lengthAwarePaginator->perPage();

        if (!empty($lengthAwarePaginator)) {
            if (!is_array($lengthAwarePaginator)) {
                if ($transformers) {
                    //TODO 数据转换补充
                } else {
                    $lengthAwarePaginator = $lengthAwarePaginator->toArray();
                }
            }

            $this->data = $lengthAwarePaginator['data'];
        }
    }
}