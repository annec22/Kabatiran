<script>
    
    function mapClick(){
        if(document.getElementById("mapsmenu").style.cssText !== "display: block;"){
            document.getElementById("mapsmenu").style.cssText = "display: block;";
            var elems = document.getElementsByClassName('newNav_drop')[0].style.cssText="height: 600px;";
        }else{
            document.getElementById("mapsmenu").style.cssText = "display: none;";
            var elems = document.getElementsByClassName('newNav_drop')[0].style.cssText="height: 490px;";
        }
    }
    
    $(document).ready(function() {  
         $("#menuHead").on("click", function(){
             var isMobile = navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/);
             if(isMobile){
             if($("#menuHead").attr('class')==="inactive"){
                $("#menuHead").attr('class', 'active');
                $(".newNav_drop").css({"visibility":"visible"});
                $("#menuHead p").css({"background":"url('<?php echo base_url() ?>styles/pictures/header_pictures/menu1.png') -50px 0px no-repeat", "height":"50px", "width":"50px", "background-size": "cover"});
             
             }else{
                 
                 
                     $("#menuHead").attr('class', 'inactive');
                     $(".newNav_drop").css({"visibility":"hidden"});
                     $("#menuHead p").css({"background":"url('<?php echo base_url() ?>styles/pictures/header_pictures/menu1.png') 0px 0px no-repeat", "height":"50px", "width":"50px", "background-size": "cover"});
                 
             }
             }
         });
         
          $("#menuHead").hover(function(){
              
              var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
              if(iOS){
                  $("#menuHead").click();
              }
          },function(){
               var isMobile = navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/);
             if(isMobile){
              $("#menuHead").attr('class', 'inactive');
              $(".newNav_drop").css({"visibility":"hidden"});
             }
          });
    });
    
    $(document).ready(function() {  
//            For Twitter
         $("#twittercbdes").on("click", function(){
             $("#twitterCB").click();
             
             if($("#twitterCB").prop('checked')){
             $("#twittercbdes").css({"background":"url('<?php echo base_url() ?>styles/pictures/social twitter.png') -100px 0px no-repeat", "background-size":"cover"});
            }else{
                $("#twittercbdes").css({"background":"url('<?php echo base_url() ?>styles/pictures/social twitter.png') 0px 0px no-repeat", "background-size":"cover"});
            }
         });
//         For Facebook
         $("#fbcbdes").on("click", function(){
             $("#facebookCB").click();
             
             if($("#facebookCB").prop('checked')){
             $("#fbcbdes").css({"background":"url('<?php echo base_url() ?>styles/pictures/social fb.png') -100px 0px no-repeat", "background-size":"cover"});
            }else{
                $("#fbcbdes").css({"background":"url('<?php echo base_url() ?>styles/pictures/social fb.png') 0px 0px no-repeat", "background-size":"cover"});
            }
         });
         
    });
    
    $(document).ready(function() {  
//            For Twitter
         $("#bull-drop-arrow").on("click", function(){
             $("#bulletin-cont").toggleClass("showblock");
             $("#bull-drop-arrow").toggleClass("bull-drop-arrow-hover");
//             $(".posto-lab").show().delay(5000).fadeOut();
         });
         
         
    });
    
</script>