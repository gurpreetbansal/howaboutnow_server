<?php
require_once("config.php");
if( isset($_SESSION['id']))
{    ?>

    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <!--<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data1').DataTable();
        } );
    </script>


    <h2 class="title left">Questions List</h2>

    <?php

    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json"
    );

    $data = array();

    $ch = curl_init( $baseurl.'profile_question');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $return = curl_exec($ch);

    $json_data = json_decode($return, true);
    $curl_error = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($json_data['code'] !== "200"){
        //echo "<div class='alert alert-danger'>Error in fetching order history, try again later..</div>";
        ?>
        <div class="textcenter nothingelse">
            <img src="img/noorder.png" alt="" />
            <h3>No Record Found</h3>
        </div>
        <?php

    } else {
        ?>

        <?php $rows = count($json_data['msg']);
        if( $rows == 0 ) {
            ?>
            <div class="textcenter nothingelse">
                <img src="img/noorder.png" alt="" />
                <h3>No Record Found</h3>
            </div>
            <?php
        }
        echo "<table id='data1' class='display' style='width:100%''>
			<thead>
	            <tr>
	                <th>S.No.</th>
	                <th>Question</th>
					<th>Actions</th>
	            </tr>
	        </thead>
			<tbody id='myTable_row'>";

        foreach( $json_data['msg'] as $str => $val ) {
            //var_dump($val);
            ?>
            <tr style=" text-align: center;">
                <td>
                    <?php
                    echo ++$str;
                    ?>
                </td>
                <td style="line-height: 20px;">
                    <?php echo $val['question'];?>
                </td>
                <td style="letter-spacing: 5px;">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal_<?=$str?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <a href=""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                </td>
            </tr>
            <div id="myModal_<?=$str?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--                            <button type="button" class="close" data-dismiss="modal">&times;</button>-->
                            <h4 class="modal-title">Profile Questions</h4>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="cat_id" value="<?=$val['id']?>" />
                            <div class="modal-body">
<!--                                <div class="form-group">-->
<!--                                    <label for="cat_name">Category Name</label>-->
<!--                                    <input type="text" name="cat_name" class="form-control" id="cat_name" value="--><?//=$val['cat_name'];?><!--" required>-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label for="sort_order">Sort Order</label>-->
<!--                                    <input type="number" name="sort_order" class="form-control" id="sort_order" value="--><?//=$val['sort_order'];?><!--" required>-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label for="exampleInputFile">File input</label>-->
<!--                                    <input type="file" name="image" id="exampleInputFile">-->
<!--                                </div>-->
                            </div>
                            <div class="modal-footer">
                                <button type="submit" onclick="submitData()" class="btn primary" >Update</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <?php
        }
        echo "</tbody>
			<tfoot>
	            <tr>
	                <th>S.No.</th>
	                <th>Question</th>
					<th>Actions</th>
	            </tr>
	        </tfoot>
	        </table> <nav><ul class='pagination pagination-sm' id='myPager'></ul></nav>";
        ///
    }

    curl_close($ch);
    ?>



<?php } else {

    @header("Location: index.php");
    echo "<script>window.location='index.php'</script>";
    die;

} ?>
