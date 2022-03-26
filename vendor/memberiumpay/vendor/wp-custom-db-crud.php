<?php



abstract 
class wp_custom_db_crud {

    
    private $table_name = false;

    
    public 
function __construct($table_name) {
        global $wpdb;
        $this->table_name = $wpdb->prefix . $table_name;
    }

    
    public 
function insert(array $data) {

        if( empty($data) ) {
            return false;
        }

        global $wpdb;
        $wpdb->insert( $this->table_name, $data );

        return $wpdb->insert_id;
    }

    
    public 
function get_all( $orderBy = NULL ) {
        global $wpdb;

        $sql = "SELECT * FROM `{$this->table_name}`";

        if( !empty($orderBy) ){
            $sql .= " ORDER BY " . $orderBy;
        }

        $all = $wpdb->get_results($sql);

        return $all;
    }

    
    public 
function get_by(array $condition_value, $condition = '=', $single_row = false) {
        global $wpdb;

        try{
            $sql = "SELECT * FROM `{$this->table_name}` WHERE ";

            $counter = 1;
            foreach ($condition_value as $field => $value) {
                if($counter > 1) {
                    $sql .= " AND ";
                }

                switch(strtolower($condition)) {
                    case "in":
                        if(!is_array($value)) {
                            throw new Exception("Values for IN query must be an array.", 1);
                        }
                        $sql .= $wpdb->prepare( "`%s` IN (%s)", $field, implode(',', $value) );
                        break;

                    default:
                        $sql .= $wpdb->prepare( "`{$field}` {$condition} %s", $value );
                        break;
                }

                $counter++;
            }

            $result = $wpdb->get_results($sql);

                        if( count($result) == 1 && $single_row ){
                $result = $result[0];
            }

            return ( is_null($result) ) ? false : $result;
        }
        catch(Exception $ex) {
            return false;
        }
    }

    
    public 
function update(array $data, array $condition_value) {
        global $wpdb;

        if( empty($data) ) {
            return false;
        }

        $updated = $wpdb->update( $this->table_name, $data, $condition_value );

        return $updated;
    }

    
    public 
function delete(array $condition_value) {
        global $wpdb;

        $deleted = $wpdb->delete( $this->table_name, $condition_value );

        return $deleted;
    }
}
?>
