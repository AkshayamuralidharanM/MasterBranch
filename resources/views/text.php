'<a style="margin-left: 5px;margin-right: 5px" id="article_edit_btn" href="#article_edit_modal" data-toggle="modal" class="btn btn-warning m-btn m-btn--icon  m-btn--icon-only  m-btn--pill m-btn--air">
                            <i class="la la-edit"></i>
                        </a>';




                        <div class="modal fade" tabindex="-1" id="article_edit_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document" style="max-width: 675px">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #00c5dc;border-radius: 4px">
                                        <h5 class="modal-title" id="exampleModalLabel" style="color: #ffffff" >
                                            Edit
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">
                                                &times;
                                            </span>
                                        </button>
                                    </div>
                                    <form id="form_article_edit" method="post" action="<?php echo base_url().$user_directory.'category/update'?>" class="m-form m-form--fit m-form--state m-form--label-align-right " enctype="multipart/form-data" >
                                        <div class="modal-body">
                                            <div class="m-form__content">
                                                <div class="m-alert m-alert--icon alert alert-warning m--hide" role="alert" id="form_article_edit_msg">
                                                    <div class="m-alert__icon">
                                                        <i class="la la-warning"></i>
                                                    </div>
                                                    <div class="m-alert__text">
                                                        Oh snap! Change a few things up and try submitting again.
                                                    </div>
                                                    <div class="m-alert__close">
                                                        <button type="button" class="close" data-close="alert" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                            </div>


                                           


 
                                            $('body').on('click', '#article_edit_btn', function() {
        var no = $(this).closest('tr').children('td');
     //   alert(no);

        $('#eid').val(no.eq(0).text());
        $('#edit_name').val(no.eq(1).text());
        $('#title1').val(no.eq(3).text());
        $('#title2').val(no.eq(4).text());
        $('#description1').val(no.eq(5).text());
        
                    
        $('#edit_designation').val(no.eq(10).text()).trigger('change');
        $('#designation_id').val(no.eq(2).text()).trigger('change');
    })

                                           



                                          
                                              


                                            <div class="row">
                                                <div class="col-lg-12" >
                                                    <label class="col-lg-2 col-form-label">
                                                        Student ID :
                                                    </label>
                                                    <div class="col-lg-12">
                                                        <div class="form-group m-form__group">
                                                           
                                                         <input type="text" name="title" id="title1" class="form-control m-input" > 

                                                        </div>
                                                    </div>

                                                    <span class="m-form__help"></span>
                                                </div>

                                            </div>
                                                




                                            <div class="row">
                                             
                                                <div class="col-lg-12" >
                                                    <label class="col-lg-2 col-form-label">
                                                    Certificate:
                                                    </label>
                                                    <div class="col-lg-12">
                                                        <div class="form-group m-form__group">
                                                            <label class="custom-file col-lg-12">
                                                                <input   type="file" name="uploaded_file" id="img">
                                                                <span class="custom-file-control"></span>
                                                            </label>

                                                        </div>
                                                    </div>

                                                    
                                                </div>
                                            </div>



                                            

                                            

                                             <input type="hidden" name="id" id="id">
                                            <div class="m-form__seperator m-form__seperator--dashed"></div><br/>

                                        </div>
                                       


                                        <div class="modal-footer">
                                            
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary" >
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                                        