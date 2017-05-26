<link rel="stylesheet" href="assets/admin/css/compiled/user-list.css" type="text/css" media="screen" />
<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>商品列表</h3>
                <div class="span10 pull-right">
                    <a href="<?php echo yii\helpers\Url::to(['product/add']) ?>" class="btn-flat success pull-right">
                        <span>&#43;</span>
                        添加新商品
                    </a>
                </div>
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span6 sortable">
                            <span class="line"></span>商品名称
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>商品库存
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>商品单价
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>是否热卖
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>是否促销
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>促销价
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>是否上架
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>是否推荐
                        </th>

                        <th class="span3 sortable align-right">
                            <span class="line"></span>操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($products as $product): ?>
                        <!-- row -->
                        <tr class="first">
                            <td>
                                <img src="<?php echo $product->cover ?>-coversmall" class="img-circle avatar hidden-phone" />
                                <a href="<?php echo yii\helpers\Url::to(['product/detail', 'product_id' => $product->product_id]) ?>" class="name"><?php echo $product->title ?></a>
                            </td>
                            <td>
                                <?php echo $product->num ?>
                            </td>
                            <td>
                                <?php echo $product->price ?>
                            </td>
                            <td>
                                <?php
                                $isHot = ['不热卖', '热卖'];
                                echo $isHot[$product->is_hot];
                                ?>
                            </td>
                            <td>
                                <?php
                                $isSale = ['不促销', '促销'];
                                echo $isSale[$product->is_sale];
                                ?>

                            </td>
                            <td>
                                <?php echo $product->sales_price ?>
                            </td>
                            <td>
                                <?php
                                $isOn = ['下架', '上架'];
                                echo $isOn[$product->is_on];
                                ?>

                            </td>
                            <td>
                                <?php
                                $isTui = ['不推荐', '推荐'];
                                echo $isTui[$product->is_tui];
                                ?>

                            </td>

                            <td class="align-right">
                                <a href="<?php echo yii\helpers\Url::to(['product/mod', 'product_id' => $product->product_id]) ?>">编辑</a>
                                <a href="<?php echo yii\helpers\Url::to(['product/on', 'product_id' => $product->product_id]) ?>">上架</a>
                                <a href="<?php echo yii\helpers\Url::to(['product/off', 'product_id' => $product->product_id]) ?>">下架</a>
                                <a href="<?php echo yii\helpers\Url::to(['product/del', 'product_id' => $product->product_id]) ?>">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination pull-right">
                <?php echo yii\widgets\LinkPager::widget(
                    [
                        'pagination' => $pager,
                        'prevPageLabel' => '&#8249;',
                        'nextPageLabel' => '&#8250;',
                    ]
                );?>
            </div>
            <!-- end users table -->
        </div>
    </div>
</div>
<!-- end main container -->
