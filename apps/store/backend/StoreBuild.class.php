<?php
/**
 * Created by PhpStorm.
 * User: nemo
 * Date: 14-8-8
 * Time: 10:46
 */

class StoreBuild extends CommonBuildAction {

    protected $workflows = array(
        "stockin" => array(
            "name"  => "入库工作流",
            "workflow_file" => "Stockin",
            "memo" => "",

            "_rows" => array(
                "StartProcess" => array(
                    "name" => "新建入库单",
                    "type" => 1,
                    "listorder" => 0,
                    "prev_node_id" => 0,
                    "next_node_id" => "ConfirmStockin",
                    "status_text" => "新入库单"
                ),
                "ConfirmStockin" => array(
                    "name" => "确认入库",
                    "type" => 1,
                    "listorder" => 1,
                    "prev_node_id" => "StartProcess",
                    "next_node_id" => "ConfirmStockin",
                    "status_text" => "正在入库"
                ),
                "CompleteProcess" => array(
                    "name" => "完成入库",
                    "type" => 1,
                    "listorder" => 2,
                    "prev_node_id" => "ConfirmStockin",
                    "next_node_id" => 0,
                    "status_text" => "已入库完成"
                )
            )
        ),

        "stockout" => array(
            "name" => "出库工作流",
            "workflow_file" => "Stockout",
            "memo" => "",

            "_rows" => array(
                "StartProcess" => array(
                    "name" => "新建出库单",
                    "type" => 1,
                    "listorder" => 0,
                    "prev_node_id" => 0,
                    "next_node_id" => "ConfirmStockout,RejectStockout",
                    "status_text" => "新出库单"
                ),
                "ConfirmStockout" => array(
                    "name" => "确认出库",
                    "type" => 7,
                    "listorder" => 1,
                    "prev_node_id" => "StartProcess",
                    "next_node_id" => "MakeExpress,Complete",
                    "status_text" => "出库单已确认"
                ),
                "RejectStockout" => array(
                    "name" => "驳回出库",
                    "type" => 7,
                    "listorder" => 1,
                    "prev_node_id" => "startProcess",
                    "next_node_id" => 0,
                    "status_text" => "出库单已驳回"
                ),
                "MakeExpress" => array(
                    "name" => "生成发货单",
                    "type" => 1,
                    "listorder" => 2,
                    "prev_node_id" => "ConfirmStockout",
                    "next_node_id" => "Complete",
                    "status_text" => "待发货"
                ),
                "Complete" => array(
                    "name" => "完成出库",
                    "type" => 2,
                    "listorder" => 3,
                    "prev_node_id" => "ConfirmStockout,MakeExpress",
                    "next_node_id" => 0,
                    "status_text" => "已完成"
                )
            )
        )
    );

    protected $authNodes = array(
        "store.stock.*",
        "store.stockin.*",
        "store.stockout.*",
        "store.stockwarning.read",
        "store.stockproductlist.*"
    );

} 