<?php
//Redirect To Page
function redirect($page = FALSE, $message = NULL, $message_type = NULL)
{
    if (is_string($page)) {
        $location = $page;
    } else {
        $location = $_SERVER['SCRIPT_NAME'];
    }

    //Check For Message
    if ($message != NULL) {
        //Set Message
        $_SESSION['message'] = $message;
    }
    //Check For Type
    if ($message_type != NULL) {
        //Set Message Type
        $_SESSION['message_type'] = $message_type;
    }

    //Redirect
    header('Location: ' . $location);
    exit;
}

//Display Message
function displayMessage()
{
    if (!empty($_SESSION['message'])) :

        //Assign Message Var
        $message = $_SESSION['message'];

        if (!empty($_SESSION['message_type'])) :
            //Assign Type Var
            $message_type = $_SESSION['message_type'];
            //Create Output
            if ($message_type == 'error') : ?>
                <div class="alert alert-danger alert-dismissible fade show m-0 rounded-0" role="alert">
                    <strong><?php echo $message; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php else : ?>
                <div class="alert alert-success alert-dismissible fade show m-0 rounded-0" role="alert">
                    <strong><?php echo $message; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
            endif;
        endif;



        //Unset Message
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    endif;
}
