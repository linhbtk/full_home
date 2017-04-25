<?php

    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */

    class AIOTreeFunction
    {

        public static function getTreeArray($preCheckValue = NULL)
        {
            $criteria            = new CDbCriteria();
            $criteria->select    = 't.id, cd.name as name';
            $criteria->join      = 'INNER JOIN tbl_categories_detail cd on cd.categories_id=t.id';
            $criteria->condition = 't.status=:status AND parent_id=0';
            $criteria->params    = array(':status' => ACategories::CATEGORY_ACTIVE);

            $criteria->order = '`name` asc';
            $operatorObj     = ACategories::model()->findAll($criteria);

            $operator     = CHtml::listData($operatorObj, 'id', 'name');
            $operator_ary = array();

            foreach ($operator as $key => $value) {
                $operator_ary[$key] = array(
                    'parentid' => '',
                    'value'    => $key,
                    'text'     => $value,
                    'checked'  => self::checkedValue($key, $preCheckValue),
                );

                self::getArrayChild($preCheckValue, $key, $operator_ary);
            }
            return $operator_ary;
        }

        /**
         * @param $preCheckValue
         * @param $parent_id
         * @param $operator_ary
         */
        public static function getArrayChild($preCheckValue, $parent_id, &$operator_ary)
        {
            $criteria_sub            = new CDbCriteria();
            $criteria_sub->select    = 't.id, cd.name as name';
            $criteria_sub->join      = 'INNER JOIN tbl_categories_detail cd on cd.categories_id=t.id';
            $criteria_sub->condition = 't.status=:status AND t.parent_id=:parent_id';
            $criteria_sub->params    = array(':status' => ACategories::CATEGORY_ACTIVE, ':parent_id' => $parent_id);
            $sub                     = ACategories::model()->findAll($criteria_sub);
            if (count($sub) > 0) {
                $sub = CHtml::listData($sub, 'id', 'name');
                foreach ($sub as $key => $value) {
                    $key_sub                = $parent_id . '_' . $key;
                    $operator_ary[$key] = array(
                        'parentid' => $parent_id,
                        'value'    => $key_sub,
                        'text'     => $value,
                        'checked'  => self::checkedValue($key_sub, $preCheckValue),
                    );
                    self::getArrayChild($preCheckValue, $key, $operator_ary);
                }
            }
        }

        private static function checkedValue($key, $preCheckValue)
        {
            if (isset($preCheckValue)) {
                if (is_array($preCheckValue) && in_array($key, $preCheckValue)) {
                    return TRUE;
                }
            }

            return FALSE;
        }

        public static function getValidAry($ary_input)
        {
            if (is_array($ary_input)) {
                $parent = array();
                //$child  = array_filter($ary_input, "AFunction::is_not_number");
                // print_r($child);die;
                foreach ($ary_input as $str) {

                    $temp = explode('_', $str);

                    if (count($temp) > 1) {
                        $parent[$temp[0]][] = $temp[1];
                    } else {
                        $parent[$temp[0]] = array();
                    }
                }
                if (count($parent) > 0)
                    return $parent;
                else
                    return FALSE;
            }

            return FALSE;
        }

        public static function getValidAryConvert($ary_input)
        {
            //print_r(unserialize('a:31:{i:0;s:1:"1";i:19;s:1:"2";i:20;s:1:"3";i:28;s:3:"1_5";i:29;s:3:"1_6";i:30;s:3:"1_8";i:31;s:3:"1_9";i:32;s:4:"1_10";i:33;s:4:"1_11";i:34;s:4:"1_12";i:35;s:4:"1_13";i:36;s:4:"1_14";i:37;s:4:"1_15";i:38;s:4:"1_16";i:39;s:4:"1_17";i:40;s:4:"1_21";i:41;s:4:"1_22";i:42;s:4:"1_25";i:43;s:4:"1_26";i:44;s:4:"1_27";i:45;s:4:"1_30";i:46;s:4:"1_37";i:47;s:3:"2_2";i:48;s:3:"3_1";i:49;s:3:"3_3";i:50;s:3:"3_6";i:51;s:3:"3_8";i:52;s:3:"3_9";i:53;s:4:"3_15";i:54;s:4:"3_27";i:55;s:4:"3_37";}'));die;
            if (is_array($ary_input)) {
                $return = array();
                foreach ($ary_input as $k => $v) {
                    $return[] = $k;
                    if (is_array($v)) {
                        foreach ($v as $sk => $sv) {
                            $return[] = $k . '_' . $sv;
                        }
                    }
                }

                if (count($return) > 0)
                    return $return;
                else
                    return FALSE;
            }

            return FALSE;
        }
    }

?>
