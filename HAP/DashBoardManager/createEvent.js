/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


  $(document).ready(function() {
    $('#event_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            event_name: {
                validators: {
                        stringLength: {
                        min: 4,
                    },
                        notEmpty: {
                        message: 'Please supply your first name'
                    }
                }
            },
             other_event_type: {
                validators: {
                     stringLength: {
                        min: 4,
                    },
                    notEmpty: {
                        message: 'Please supply event Type'
                    }
                }
            },
            event_type: {
                validators: {
                      notEmpty: {
                        message: 'Please supply the Event Type'
                    },
                   
                    }
                
            },
            
                   
            event_address: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please supply your street address'
                    }
                }
            },
            event_city: {
                validators: {
                     stringLength: {
                        min: 4,
                    },
                    notEmpty: {
                        message: 'Please supply your city'
                    }
                }
            },
            event_state: {
                validators: {
                    notEmpty: {
                        message: 'Please select your state'
                    }
                }
            },
            event_zip: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your zip code'
                    },
                    zipCode: {
                        country: 'US',
                        message: 'Please supply a vaild zip code'
                    }
                }
            },
          
            require_Resources: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 1000,
                        message:'Please enter at least 10 characters and no more than 1000'
                    },
                    notEmpty: {
                        message: 'Please supply a Required Resources of your project'
                    }
                    }
                },
                     event_description: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 1000,
                        message:'Please enter at least 10 characters and no more than 1000'
                    },
                    notEmpty: {
                        message: 'Please supply a Event Description of your project'
                    }
                    }
                }
          
            }
        })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#event_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});

