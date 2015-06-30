<?php
/**
 * 版本处理类，提供版本与数字互相转换，方便入库后进行比较筛选
 *  Date:       2015-06-30
 *  Author:     fdipzone
 *  ver:        1.0
 *
 *  Func:
 *  public  version_to_integer  将版本转为数字
 *  public  integer_to_version  将数字转为版本
 *  public  check               检查版本格式是否正确
 *  public  compare             比较两个版本的值
 */

class Version{ // class start

    /**
     * 将版本转为数字
     * @param  String $version 版本
     * @return Int
     */
    public function version_to_integer($version){
        if($this->check($version)){
            list($major, $minor, $sub) = explode('.', $version);
            $integer_version = $major*10000 + $minor*100 + $sub;
            return intval($integer_version);
        }else{
            throw new ErrorException('version Validate Error');
        }
    }

    /**
     * 将数字转为版本
     * @param  Int     $version_code 版本的数字表示
     * @return String
     */
    public function integer_to_version($version_code){
        if(is_numeric($version_code) && $version_code>=10000){
            $version = array();
            $version[0] = (int)($version_code/10000);
            $version[1] = (int)($version_code%10000/100);
            $version[2] = $version_code%100;
            return implode('.', $version);
        }else{
            throw new ErrorException('version code Validate Error');
        }
    }

    /**
     * 检查版本格式是否正确
     * @param  String  $version 版本
     * @return Boolean
     */
    public function check($version){
        $ret = preg_match('/^[0-9]{1,3}\.[0-9]{1,2}\.[0-9]{1,2}$/', $version);
        return $ret? true : false;
    }

    /**
     * 比较两个版本的值
     * @param  String  $version1  版本1
     * @param  String  $version2  版本2
     * @return Int                -1:1<2, 0:相等, 1:1>2
     */
    public function compare($version1, $version2){
        if($this->check($version1) && $this->check($version2)){
            $version1_code = $this->version_to_integer($version1);
            $version2_code = $this->version_to_integer($version2);

            if($version1_code>$version2_code){
                return 1;
            }elseif($version1_code<$version2_code){
                return -1;
            }else{
                return 0;
            }
        }else{
            throw new ErrorException('version1 or version2 Validate Error');
        }
    }

} // class end

?>