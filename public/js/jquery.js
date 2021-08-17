 
 //price field
 var field = "<div class='col-12' id='dissapear' ><div class='form-floating  mb-3'>" + 
 "<input type='number' name='seriesPrice' class='form-control' id='seriesPrice' placeholder='Series Price here' required min='500' max='8000'>" + 
 "<label for='seriesPrice'>Price</label>" + 
"</div></div>";

 $(document).ready(function()
        {
          // accpet
          $(document).on('click', "#Accept", function(e)
          {
            //get the id of the user
            var id = $(this).attr('data-id');

            //get the active link of the pagination
            var page = $(".active a").attr('data-page');
            // alert(page);
            
            //disappear the accepted record
            $(this).parents("tr").fadeOut(1000);

            $.ajax(
              {
              url:"/tutorialTube/public/Admin/AdminClass/accept",
              type:"post",
              data:{"id":id},
              success:function(data)
              {
                  // alert(data);
                  //show message that mail is send
                  $("#message").html(data);

                  //load the updated records
                  loadTable(page);
              }
              }
            );
            
          });

          // delete
          $(document).on('click', "#Delete", function(e)
          {
           
            //get the  id of the user to reject the record
            var id = $(this).attr('data-id');

            //get the active link of the pagination
            var page = $(".active a").attr('data-page');

            //get the reason to reject the user
            var reason = window.prompt("Tell the reason to delete the account of the user?");

          //  alert(reason);

          //if reason given
            if(reason != "" && reason != null)
            {
                  //disappear the reject record
                  $(this).parents("tr").fadeOut(1000);

                  $.ajax(
                  {
                  url:"/tutorialTube/public/Admin/AdminClass/delete",
                  type:"post",
                  data:{"id":id, "message":reason},
                  success:function(data)
                  {
                      // alert(data);

                      //show the message mail is send
                      $("#message").html(data);

                      //load the updated record
                      loadTable(page);
                  }
                  }
                  );
            }
            else  //if reason not given
            {
                alert("First tell the reason then you can delete the account of the user");

                // loadTable();
            }
          });


          // reject
          $(document).on('click', "#Reject", function(e)
          {
           
            //get the  id of the user to reject the record
            var id = $(this).attr('data-id');

            //get the active link of the pagination
            var page = $(".active a").attr('data-page');

            //get the reason to reject the user
            var reason = window.prompt("Tell the reason to reject the request of the user?");

          //  alert(reason);

          //if reason given
            if(reason != "" && reason != null)
            {
                  //disappear the reject record
                  $(this).parents("tr").fadeOut(1000);

                  $.ajax(
                  {
                  url:"/tutorialTube/public/Admin/AdminClass/reject",
                  type:"post",
                  data:{"id":id, "message":reason},
                  success:function(data)
                  {
                      // alert(data);

                      //show the message mail is send
                      $("#message").html(data);

                      //load the updated record
                      loadTable(page);
                  }
                  }
                  );
            }
            else  //if reason not given
            {
                alert("First tell the reason then you can reject the request of the user");

                // loadTable();
            }
          });

          //pagination button for user request
          $(document).on("click", "#pagination a", function(e)
          {
              e.preventDefault();

              //get the page number of the clicked button
              var pageHref = $(this).attr('href');
              var split = pageHref.split("?page=");
              var page = split[1];
              // alert(page);
            
            //show the next record
              loadTable(page);
          });

          //search
          $(document).on("submit", "#search", function(e)
          {
              e.preventDefault();

              var firstName = $("#firstName").val();
              var lastName = $("#lastName").val();
              var email = $("#email").val();
              var pageLink = $("#pageLink").text();
              // alert(firstName);
              // alert(lastName);
              // alert(email);

              //if any filter given
              if(firstName != "" || lastName != "" || email != "")
              {
                // alert("yes");
                $.ajax(
                  {
                    url:pageLink,
                    type:"post",
                    data:{"firstName":firstName, "lastName":lastName, "email":email},
                    success:function(data)
                    {
                      // alert("Ahmad");
                      data = JSON.parse(data);
                      // console.log(data);

                      //show validation errors
                      if(data[0]==1)
                      {
                        $("#errors").html(data[1]);
                      }
                      else  //show data
                      {
                        //remove validation errors that are already show this is doing because we use ajax
                        $("#errors div:first").fadeOut();
                        $("#table").html(data[1]);
                      }
                       
                    }
                  }
              );
              }
              else  //if filter not given
              {
                alert("Please enter something to search");

                //if filter remove then loadTable from db
                loadTable();
                // alert("AHMAD");
              }
          });

          //disappear or display the price field on changing the series category
          
          $(document).on("change", "#seriesCategory", function() {

            // check is the series is paid or free
            var value = this.value;

            //if series is free then dispear the amount field
            if(value == 1)
            {
              $("#amountField #dissapear").remove();
            }
            else if(value == 2)
            {
            
              //filed is declare in top
              $("#amountField").html(field)
            }
          });

           //show price field if page refresh
           var seriesCategory = $("#seriesCategory").val();
           // alert(1);
           // alert(seriesCategory);
           if(seriesCategory == 2)
           {
               $("#amountField").html(field);

               //get the price of the amount and show in amount field this is for refresh of the page
               var price = $("#price" ).text();
                $("#amountField #dissapear #seriesPrice").val(price);

               
           }

          //password match
          $(document).on("submit", "#signUp", function(e)
          {

            var password = $("#Password").val();
            var confirmPassword = $("#ConfirmPassword").val();
            if(password != confirmPassword)
            {
              e.preventDefault();
              var info = "<div class='mt-xl-5 mt-sm-2 mt-0 mb-sm-2 mb-3 alert alert-danger alert-dismissible fade show text-muted' role='alert'>" +
              "Confirm Password is not match with the Password Field" +
              "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>"; +
              "</div>";
              $("#passwordMismatch").html(info);
            }
            

          });

          // pagination button to show series
          $(document).on("click", "#seriesPagination a", function(e)
          {
            // alert("Ahmad");
              e.preventDefault();

              //get the page number of the clicked button
              var pageHref = $(this).attr('href');
              var split = pageHref.split("?page=");
              var page = split[1];
            // alert(page);
            
            //show the next record
              loadSeries(page);
          });
          

          $(document).on("click", "#paginationSeries a", function(e)
          {
              e.preventDefault();
            
              //get the page number of the clicked button
              var pageHref = $(this).attr('href');
              // alert(pageHref);
              var split = pageHref.split("?page=");
              var page = split[1];
              //  alert(page);
            
            //show the next record
              loadTableSeries(page);
          });

          $(document).on('click', "#AcceptSeries", function(e)
          {
            //get the id of the user
            var id = $(this).attr('data-id');
            // alert(id);

            //get the active link of the pagination
            var page = $(".active a").attr('data-page');
            // alert(page);
            
            //disappear the accepted record
            $(this).parents("tr").fadeOut(1000);

            $.ajax(
              {
              url:"/tutorialTube/public/Admin/AdminClass/acceptSeries",
              type:"post",
              data:{"id":id},
              success:function(data)
              {
                //alert("AHmad");
                  // alert(data);
                  //show message that mail is send
                  $("#message").html(data);

                  //load the updated records
                  loadTableSeries(page);
              }
              }
            );
            
          });

           // reject
           $(document).on('click', "#RejectSeries", function(e)
           {
            
             //get the  id of the user to reject the record
             var id = $(this).attr('data-id');
 
             //get the active link of the pagination
             var page = $(".active a").attr('data-page');
 
             //get the reason to reject the user
             var reason = window.prompt("Tell the reason to reject the request of the series?");
 
           //  alert(reason);
 
           //if reason given
             if(reason != "" && reason != null)
             {
                   //disappear the reject record
                   $(this).parents("tr").fadeOut(1000);
 
                   $.ajax(
                   {
                   url:"/tutorialTube/public/Admin/AdminClass/rejectSeries",
                   type:"post",
                   data:{"id":id, "message":reason},
                   success:function(data)
                   {
                       // alert(data);
 
                       //show the message mail is send
                       $("#message").html(data);
 
                       //load the updated record
                       loadTableSeries(page);
                   }
                   }
                   );
             }
             else  //if reason not given
             {
                 alert("First tell the reason then you can reject the request of the series");
 
                 // loadTable();
             }
           });
 
            // delete
            $(document).on('click', "#DeleteSeries", function(e)
            {
             
              //get the  id of the user to reject the record
              var id = $(this).attr('data-id');
  
              //get the active link of the pagination
              var page = $(".active a").attr('data-page');
  
              //get the reason to reject the user
              var reason = window.prompt("Tell the reason to delete the request of the series?");
  
            //  alert(reason);
  
            //if reason given
              if(reason != "" && reason != null)
              {
                    //disappear the reject record
                    $(this).parents("tr").fadeOut(1000);
  
                    $.ajax(
                    {
                    url:"/tutorialTube/public/Admin/AdminClass/deleteSeries",
                    type:"post",
                    data:{"id":id, "message":reason},
                    success:function(data)
                    {
                        // alert(data);
  
                        //show the message mail is send
                        $("#message").html(data);
  
                        //load the updated record
                        loadTableSeries(page);
                    }
                    }
                    );
              }
              else  //if reason not given
              {
                  alert("First tell the reason then you can delete the request of the series");
  
                  // loadTable();
              }
            });


           $(document).on("submit", "#seriesSearch", function(e)
           {
               e.preventDefault();
 
               var seriesName = $("#seriesName").val();
               var email = $("#email").val();
               var seriesType = $("#seriesType").val();
               var seriesCategory = $("#seriesCategory").val();

               //for different link because views are smae
               var pageLink = $("#pageLink").text();
              //  alert(seriesName);
              //  alert(email);
              //  alert(seriesType);
              //  alert(seriesCategory);
 
               //if any filter given
               if(seriesName != "" || email != "" || seriesType != "" || seriesCategory != "")
               {
                 // alert("yes");
                 $.ajax(
                   {
                     url:pageLink,
                     type:"post",
                     data:{"seriesName":seriesName, "email":email, "seriesType":seriesType, "seriesCategory":seriesCategory},
                     success:function(data)
                     {
                       // alert("Ahmad");
                       data = JSON.parse(data);
                       // console.log(data);
 
                       //show validation errors
                       if(data[0]==1)
                       {
                         $("#errors").html(data[1]);
                       }
                       else  //show data
                       {
                         //remove validation errors that are already show this is doing because we use ajax
                         $("#errors div:first").fadeOut();
                         $("#table").html(data[1]);
                       }
                        
                     }
                   }
               );
               }
               else  //if filter not given
               {
                 alert("Please enter something to search");
 
                 //if filter remove then loadTable from db
                 loadTableSeries();
                 // alert("AHMAD");
               }
           });
          
        

           //on load
          //for showing feedback and comment of the playing tutorial 
        $("#list-tab .active", function()
        {
          userId = $("#video").attr("data-userId");
          // alert(userId);
          if(userId != undefined)
          {
            updateCourseDetail();
          }
        });

        //on click
        $(document).on('click',"#list-tab .active", function()
        {
          updateCourseDetail();
        });

        $(document).on("submit","#commentForm", function(e)
        {
            e.preventDefault();
           comment =  $("#input").val();
           userId =  $("#userId").val();
            tutorialId = $("#video").attr("data-tutorialId");
            // alert(comment);
            // alert(userId);
            // alert(tutorialId);

            //if user login
            if(userId != 0 )
            {
              //if comment is not empty then add comment
              if(comment != "")
              {
                $.ajax(
                  {
                    url:'/tutorialTube/public/series/addComment',
                    type:'post',
                    data:{'userId':userId, "tutorialId":tutorialId, "comment":comment},
                    success:function(data)
                    {
                      //show all the comment
                      showComment(tutorialId);

                      //clear the comment field
                      $("#input").val("")
                    }
                  });
              }
              else
              {
                alert("Please enter something to post your comment");
              }
            } 
            else  //user not login
            {
              alert("Visitor not allowed to post comment");
              $("#input").val("")
            }
        });

        $(document).on('click', ".forFeedback", function(e)
        {
          //for like and dislike
           tutorialId = $("#list-tab .active").attr("data-id");
           userId = $("#video").attr("data-userId");

           //set type type 2 is for like and dislike
           type = 2;
           
          if(userId != 0)
          {

            //get the id of the class
            var  id = $(this).attr("id");
          // alert("clas" + id);
         
          
          if(id == "classLike")
          {
            //if already like then reverse the like
            if($("#classLike").hasClass('text-primary'))
            {

              feedback = 0
              $("#classLike").removeClass("text-primary");
            }
            else
            {
              //if already not like then add like
              $(this).toggleClass('text-primary');
              $("#classDislike").removeClass("text-primary");
              feedback = 1
            }
          }
          if(id == "classDislike")
          {
            //if already dislike then reverse the dislike
            if($("#classDislike").hasClass('text-primary'))
            {
              feedback = 0
              $("#classDislike").removeClass("text-primary");
            }
            else
            {
              //if already not dislike then add dislike
              $(this).toggleClass('text-primary');
              $("#classLike").removeClass("text-primary");
              feedback = 2
            }
            
          }
          // alert("feed" + feedback)

          addview(type, tutorialId, userId, feedback);
          }
          else
          {
            //user not login
            alert("Visitors are not allowed to give feedback");
          }
          // console.log(18);
          // showFeedback(tutorialId, userId);
        });

        $(document).on('click', "#voucher", function(e)
        {
          //ger series id for voucher generation
            var seriesId = $(this).attr('data-seriesId');
            // alert(seriesId);

            //confrim from user to generate voucher
            var flag = confirm("Do you really want to generate voucher?");
            // console.log(flag);

            //if user agree
            if(flag == true)
            {
              //download pdf
            fetch('http://localhost/tutorialTube/public/Series/createPdf/' + seriesId)
            .then(resp => resp.blob())
            .then(blob => {
              const url = window.URL.createObjectURL(blob);
              const a = document.createElement('a');
              a.style.display = 'none';
              a.href = url;
              // the filename you want
              a.download = 'Voucher.pdf';
              document.body.appendChild(a);
              a.click();
              window.URL.revokeObjectURL(url);
                // or you know, something with better UX...
            })
            .catch(() => alert('oh no!'));
            
            } 
        
        });

        //voucher pagination
        $(document).on("click", "#paginationVoucher a", function(e)
        {
            e.preventDefault();
          
            //get the page number of the clicked button
            var pageHref = $(this).attr('href');
            // alert(pageHref);
            var split = pageHref.split("?page=");
            var page = split[1];
            //  alert(page);
          
          //show the next record
            loadTableVoucher(page);
        });

        //vouchersearch
        $(document).on("submit", "#voucherSearch", function(e)
        {
            e.preventDefault();

            var seriesName = $("#seriesName").val();
            var email = $("#email").val();
            var seriesType = $("#seriesType").val();
            var voucherId = $("#voucherId").val();

            //for different link because views are smae
            var pageLink = $("#pageLink").text();
            // alert(pageLink);
            // alert(voucherId);
            // alert(seriesName);
            // alert(email);
            // alert(seriesType);
            

            //if any filter given
            if(seriesName != "" || email != "" || seriesType != "" || voucherId != "")
            {
              // alert("yes");
              $.ajax(
                {
                  url:pageLink,
                  type:"post",
                  data:{"seriesName":seriesName, "email":email, "seriesType":seriesType, "voucherId":voucherId},
                  success:function(data)
                  {
                    //alert(data);
                    data = JSON.parse(data);
                    // console.log(data);

                    //show validation errors
                    if(data[0]==1)
                    {
                      $("#errors").html(data[1]);
                    }
                    else  //show data
                    {
                      //remove validation errors that are already show this is doing because we use ajax
                      $("#errors div:first").fadeOut();
                      $("#table").html(data[1]);
                    }
                     
                  }
                }
            );
            }
            else  //if filter not given
            {
              alert("Please enter something to search");

              //if filter remove then loadTable from db
              loadTableVoucher();
              // alert("AHMAD");
            }
        });
 
        $(document).on('click', "#DeleteVoucher", function(e)
            {
             
              //get the  id of the user to reject the record
              var voucherId = $(this).attr('data-VoucherId');
  
              //get the active link of the pagination
              var page = $(".active a").attr('data-page');
  
              //get the reason to reject the user
              var reason = confirm("Do you really want to delete the record");
  
            //  alert(reason);
  
            //if reason given
              if(reason)
              {
                    //disappear the reject record
                    $(this).parents("tr").fadeOut(1000);
  
                    $.ajax(
                    {
                    url:"/tutorialTube/public/Admin/AdminClass/deleteVoucher",
                    type:"post",
                    data:{"voucherId":voucherId},
                    success:function(data)
                    {
                        // alert(data);
  
                        //show the message mail is send
                        $("#message").html(data);
  
                        //load the updated record
                        loadTableVoucher(page);
                    }
                    }
                    );
              }
            });

            $(document).on('click', "#DeleteVoucherPath", function(e)
            {
             
              //get the  id of the user to reject the record
              var voucherId = $(this).attr('data-VoucherId');
  
              //get the active link of the pagination
              var page = $(".active a").attr('data-page');
  
              //get the reason to reject the user
              var reason = confirm("Do you really want to delete the voucher");
  
            //  alert(reason);
  
            //if reason given
              if(reason)
              {
                    //disappear the reject record
                    $(this).parents("tr").fadeOut(1000);
  
                    $.ajax(
                    {
                    url:"/tutorialTube/public/Admin/AdminClass/deleteVoucherPath",
                    type:"post",
                    data:{"voucherId":voucherId},
                    success:function(data)
                    {
                        // alert(data);
  
                        //show the message mail is send
                        $("#message").html(data);
  
                        //load the updated record
                        loadTableVoucher(page);
                    }
                    }
                    );
              }
            });

            $(document).on('click', "#AcceptVoucher", function(e)
            {
             
              //get the  id of the user to reject the record
              var voucherId = $(this).attr('data-VoucherId');
  
              //get the active link of the pagination
              var page = $(".active a").attr('data-page');
  
              //get the reason to reject the user
              var reason = confirm("Do you really want to accept the voucher");
  
            //  alert(reason);
  
            //if reason given
              if(reason)
              {
                    //disappear the reject record
                    $(this).parents("tr").fadeOut(1000);
  
                    $.ajax(
                    {
                    url:"/tutorialTube/public/Admin/AdminClass/acceptVoucher",
                    type:"post",
                    data:{"voucherId":voucherId},
                    success:function(data)
                    {
                        // alert(data);
  
                        //show the message mail is send
                        $("#message").html(data);
  
                        //load the updated record
                        loadTableVoucher(page);
                    }
                    }
                    );
              }
            });

            //navigation bar filters
            $(document).on('change', "#filterCategory", function(e){
              var category = $(this).val();
              // alert(category)
              // varaction = $("#filters").attr("action");
              // alert(action);
              if(category == 1)
              {
                // alert(1);
                $("#filters").attr("action", '/tutorialTube/public/series/freeSeries')
              }
              else
              {
                // alert(2);
                $("#filters").attr("action", '/tutorialTube/public/series/paidSeries')
              }
              // action = $("#filters").attr("action");
              // alert(action);
            });

            //on page load check the value of the category is paid
            var filterCategory = $('#filterCategory').val();
            if(filterCategory == 2)
            {
              $("#filters").attr("action", '/tutorialTube/public/series/paidSeries');
            }
          //document end
        });

        function loadTable(page_no = 1)
          {
              var firstName = $("#firstName").val();
              var lastName = $("#lastName").val();
              var email = $("#email").val();
              var pageLink = $("#pageLink").text();
              
              
              if(firstName != "" || lastName != "" || email != "")
              {
                // alert("yes");
                $.ajax(
                  {
                    url:pageLink,
                    type:"post",
                    data:{"page":page_no, "firstName":firstName, "lastName":lastName, "email":email},
                    success:function(data)
                    {
                      // alert("Ahmad");
                      data = JSON.parse(data);
                      // console.log(data);

                      //show validation errors
                      if(data[0]==1)
                      {
                        $("#errors").html(data[1]);
                      }
                      else
                      {
                        //remove validation errors that are already show this is doing because we use ajax
                        $("#errors div:first").fadeOut();

                        $("#table").html(data[1]);
                      }
                       
                    }
                  }
              );
              }
              else  //if filters not given
              {
                $.ajax(
                  {
                    url:pageLink,
                    type:"post",
                    data:{"page":page_no},
                    success:function(data)
                    {
                      data = JSON.parse(data);
                      // console.log(data);
                      if(data[0]==1)
                      {
                        $("#errors").html(data[1]);
                      }
                      else
                      {
                        $("#table").html(data[1]);
                      }
                    }
                  }
                );

              }
              
          }


          function loadTableSeries(page_no = 1)
          {
            var seriesName = $("#seriesName").val();
            var email = $("#email").val();
            var seriesType = $("#seriesType").val();
            var seriesCategory = $("#seriesCategory").val();
            var pageLink = $("#pageLink").text();
              
              if(seriesName != "" || email != "" || seriesType != "" || seriesCategory != "")
              {
                // alert("yes");
                $.ajax(
                  {
                    url:pageLink,
                    type:"post",
                    data:{"page":page_no, "seriesName":seriesName, "email":email, "seriesType":seriesType, "seriesCategory":seriesCategory },
                    success:function(data)
                    {
                      // alert("Ahmad");
                      data = JSON.parse(data);
                      // console.log(data);

                      //show validation errors
                      if(data[0]==1)
                      {
                        $("#errors").html(data[1]);
                      }
                      else
                      {
                        //remove validation errors that are already show this is doing because we use ajax
                        $("#errors div:first").fadeOut();

                        $("#table").html(data[1]);
                      }
                       
                    }
                  }
              );
              }
              else  //if filters not given
              {
                
                $.ajax(
                  {
                    url:pageLink,
                    type:"post",
                    data:{"page":page_no},
                    success:function(data)
                    {
                      data = JSON.parse(data);
                      // console.log(data);
                      if(data[0]==1)
                      {
                        $("#errors").html(data[1]);
                      }
                      else
                      {
                        $("#table").html(data[1]);
                      }
                    }
                  }
                );

               }
              
          }

          //load series
          function loadSeries(page_no = 1)
          {
            // alert(page_no);
            var href = $(".active").attr("href");
            var seriesType = $("#pickType").text();
            var seriesName = $("#pickName").text();
            var seriesCategory = $("#pickCategory").text();
            // alert(seriesType);
            // alert(seriesName);
            // alert(seriesCategory);
            // alert(href);
            if(seriesName != "" || seriesType != "" || seriesCategory != "")
            {
            $.ajax(
              {
                url:href,
                type:"post",
                data:{"page":page_no, "check":1, "seriesName":seriesName, "seriesType":seriesType, "seriesCategory":seriesCategory},
                success: function(data)
                {
                  // alert(data);
                  data = JSON.parse(data);
                      // console.log(data);
                      if(data[0]==1)
                      {
                        // alert("as")
                        $("#errors").html(data[1]);
                      }
                      else
                      {
                        // alert("not");
                        $("#series").html(data[1]);
                      }
                  
                }
              }
            );
            }
            else
            {
              $.ajax(
                {
                  url:href,
                  type:"post",
                  data:{"page":page_no, "check":1},
                  success: function(data)
                  {
                    // alert(data);
                  data = JSON.parse(data);
                      // console.log(data);
                      if(data[0]==1)
                      {
                        // alert("as")
                        $("#errors").html(data[1]);
                      }
                      else
                      {
                        // alert("not");
                        $("#series").html(data[1]);
                      }
                    
                  }
                }
              ); 
            }
          }
          
          //show comment
          function showComment(id)
          {

            $.ajax({
              url:'/tutorialTube/public/series/comment',
              type:'post',
              data:{"id":id},
              success:function(data)
              {
                comment = "";
                data = JSON.parse(data);
                data.forEach(function(comments)
                {

                  //combine all the comment
                comment += "<div class='col-11 bg-light mb-md-4 mb-sm-3 mb-2 ps-4 pt-2 pb-2' style=' border-radius: 5px 25px;'>" +
                "<p class='mb-0 '>" + comments.email + "</p>" +
                comments.comment+ "</div>";
                });
                $("#comment").html(comment);
              }
            });
          }
          
          function showFeedback(tutorialId, userId)
          {
            $.ajax({
              url:'/tutorialTube/public/series/feedback',
              type:'post',
              data:{"tutorialId":tutorialId, "userId":userId},
              success:function(data)
              {
                // alert(data);
                data = JSON.parse(data);
                // alert(data);
                // alert(view);
                $("#view").text(data.views);
                $("#like").text(data.like);
                $("#dislike").text(data.dislike);
                if(data.myFeedback != 0)
                {
                  
                  //user like
                  if(data.myFeedback == 1)
                  {
                    $("#classLike").addClass('text-primary');
                  }
                  else if(data.myFeedback == 2) //user dislike
                  {
                    $("#classDislike").addClass('text-primary');
                  }
                }
              }
            });
          }

          function addview(type, tutorialId, userId,feedback)
          {
             if(userId != 0)
             {
              $.ajax({
                url:'/tutorialTube/public/series/addFeedback',
                type:'post',
                data:{"type":type, "tutorialId":tutorialId, "userId":userId,"feedback":feedback},
                success:function(data)
                {
                  //first add view then show updated feedback
                  showFeedback(tutorialId, userId);
                }
               });
             }
             else
             {
              showFeedback(tutorialId, userId);
             }

          }

          function updateCourseDetail()
          {
            src = $("#list-tab .active").attr("data-src");
            tutorialId = $("#list-tab .active").attr("data-id");
             userId = $("#video").attr("data-userId");
             type = 1;
             feedback = 0;
            // alert(userId);
            $("#classLike").removeClass('text-primary');
            $("#classDislike").removeClass('text-primary');
            addview(type, tutorialId, userId, feedback);
            
            showComment(tutorialId);

            $("#video").attr("src","/tutorialTube/public/uploads/tutorial/" + src);
            $("#video").attr("data-tutorialId",tutorialId);
          }

          //load voucher
          function loadTableVoucher(page_no = 1)
          {
            var seriesName = $("#seriesName").val();
            var email = $("#email").val();
            var seriesType = $("#seriesType").val();
            var voucherId = $("#voucherId").val();
            // alert(voucherId);
            var pageLink = $("#pageLink").text();
              
              if(seriesName != "" || email != "" || seriesType != "" || voucherId != "")
              {
                // alert("yes");
                $.ajax(
                  {
                    url:pageLink,
                    type:"post",
                    data:{"page":page_no, "seriesName":seriesName, "email":email, "seriesType":seriesType, "voucherId":voucherId },
                    success:function(data)
                    {
                      // alert("Ahmad");
                      data = JSON.parse(data);
                      // console.log(data);

                      //show validation errors
                      if(data[0]==1)
                      {
                        $("#errors").html(data[1]);
                      }
                      else
                      {
                        //remove validation errors that are already show this is doing because we use ajax
                        $("#errors div:first").fadeOut();

                        $("#table").html(data[1]);
                      }
                       
                    }
                  }
              );
              }
              else  //if filters not given
              {
                //alert(pageLink);
                 $.ajax(
                  {
                    url:pageLink,
                    type:"post",
                    data:{"page":page_no},
                    success:function(data)
                    {
                      // alert(data);
                      data = JSON.parse(data);
                      // alert(data);
                      // console.log(data);
                      if(data[0]==1)
                      {
                        $("#errors").html(data[1]);
                      }
                      else
                      {
                        $("#table").html(data[1]);
                      }
                    }
                  }
                );

               }
              
          }
