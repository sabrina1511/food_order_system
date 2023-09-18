<!DOCTYPE html>
<html lang="en">
  <?php session_start(); ?>
  <head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Title -->
    <title>Tasty Shop</title>
    <?php
        if(!isset($_SESSION['login_id']))
          header('location:login.php');
      include('./include/header.php'); 
    ?>
  </head>
  <!-- Internal CSS -->
  <style>
    body{
      background: #80808045;
    }
    .modal-dialog.large {
      width: 80% !important;
      max-width: unset;
    }
    .modal-dialog.mid-large {
      width: 50% !important;
      max-width: unset;
    }
    #viewer_modal .btn-close {
      position: absolute;
      z-index: 999999;
      background: unset;
      color: white;
      border: unset;
      font-size: 27px;
      top: 0;
    }
    #viewer_modal .modal-dialog {
      width: 80%;
      max-width: unset;
      height: calc(90%);
      max-height: unset;
    }
    #viewer_modal .modal-content {
      background: black;
      border: unset;
      height: calc(100%);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    #viewer_modal img,#viewer_modal video{
      max-height: calc(100%);
      max-width: calc(100%);
    }
  </style>

  <body>
      <!-- Including Top Navigation -->
      <?php include './include/topbar.php' ?>
      <!-- Including Side Navigation -->
      <?php include './include/navbar.php' ?>
      
      <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white"></div>
      </div>  

      <!-- Main Section -->
      <main id="view-panel" >
        <?php $page = isset($_GET['page']) ? $_GET['page'] :'order'; ?>
        <?php include $page.'.php' ?>
      </main>

      <!-- Pre-Loader -->
      <div id="preloader"></div>
      <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

      <!-- Delete Button Confirmation Modal -->
      <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirmation</h5>
            </div>
            <div class="modal-body">
              <div id="delete_content"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Save Button Modal -->
      <div class="modal fade" id="uni_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"></h5>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
          </div>
        </div>
      </div>
  </body>
  <script>

    /* Start Pre-Loader */
    window.start_load = function(){
      $('body').prepend('<di id="preloader2"></di>')
    }

    /* End Pre-Loader */
    window.end_load = function(){
      $('#preloader2').fadeOut('fast', function() {
          $(this).remove();
        })
    }

    window.uni_modal = function($title = '' , $url='',$size=""){
      start_load()
      $.ajax({
          url:$url,
          error:err=>{
              console.log()
              alert("An error occured")
          },
          success:function(resp){
              if(resp){
                  $('#uni_modal .modal-title').html($title)
                  $('#uni_modal .modal-body').html(resp)
                  if($size != ''){
                      $('#uni_modal .modal-dialog').addClass($size)
                  }else{
                      $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                  }
                  $('#uni_modal').modal({
                    show:true,
                    backdrop:'static',
                    keyboard:false,
                    focus:true
                  })
                  end_load()
              }
          }
      })
    }
    window._conf = function($msg='',$func='',$params = []){
      $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
      $('#confirm_modal .modal-body').html($msg)
      $('#confirm_modal').modal('show')
    }
    window.alert_toast= function($msg = 'TEST',$bg = 'success'){
      $('#alert_toast').removeClass('bg-success')
      $('#alert_toast').removeClass('bg-danger')
      $('#alert_toast').removeClass('bg-info')
      $('#alert_toast').removeClass('bg-warning')
      
      if($bg == 'success')
        $('#alert_toast').addClass('bg-success')
      if($bg == 'danger')
        $('#alert_toast').addClass('bg-danger')
      if($bg == 'info')
        $('#alert_toast').addClass('bg-info')
      if($bg == 'warning')
        $('#alert_toast').addClass('bg-warning')
      $('#alert_toast .toast-body').html($msg)
      $('#alert_toast').toast({delay:3000}).toast('show');
    }
    $(document).ready(function(){
      $('#preloader').fadeOut('fast', function() {
          $(this).remove();
        })
    })
    $('.datetimepicker').datetimepicker({
        format:'Y/m/d H:i',
        startDate: '+3d'
    })
    $('.select2').select2({
      placeholder:"Please select here",
      width: "100%"
    })
  </script>	
</html>