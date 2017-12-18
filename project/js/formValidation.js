  $(document).ready(function() {
    $('#loginForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        message: 'This value is invalid.',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            loginPassword: {
                validators: {
                        stringLength: {
                        min: 5,
                    },
                        notEmpty: {
                        message: 'Please enter the password.'
                    }
                }
            },
            loginEmail: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address.'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address.'
                    }
                }
            }
            }
        });
  $('#registerForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        message: 'This value is invalid.',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            fullname: {
                validators: {
                        stringLength: {
                        min: 5,
                    },
                        notEmpty: {
                        message: 'Please enter your full name.'
                    }
                }
            },
            registerPassword: {
                validators: {
                        stringLength: {
                        min: 5,
                    },
                        notEmpty: {
                        message: 'Please enter the password.'
                    },
                    identical: {
                        field: 'registerPasswordConfirm',
                        message: 'The confirm password does not match the new password.'
                    }
                }
            },
            registerPasswordConfirm: {
                validators: {
                        stringLength: {
                        min: 5,
                    },
                        notEmpty: {
                        message: 'Please enter the password.'
                    },
                    identical: {
                        field: 'registerPassword',
                        message: 'The confirm password does not match the new password.'
                    }
                }
            },
            registerEmail: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address.'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address.'
                    }
                }
            }
            }
        });
    $('#loginModalForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        message: 'This value is invalid.',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'password-modal': {
                validators: {
                        stringLength: {
                        min: 5,
                    },
                        notEmpty: {
                        message: 'Please enter the password.'
                    }
                }
            },
            'email-modal': {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address.'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address.'
                    }
                }
            }
            }
        });
  $('#changePwdForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        message: 'This value is invalid.',
        fields: {
            password_old: {
                validators: {
                        stringLength: {
                        min: 5,
                    },
                        notEmpty: {
                        message: 'Please enter the old password.'
                    }
                }
            },
            password_1: {
                validators: {
                        stringLength: {
                        min: 5,
                    },
                        notEmpty: {
                        message: 'Please enter the new password.'
                    },
                    identical: {
                        field: 'password_2',
                        message: 'The confirm password does not match the new password.'
                    }
                }
            },
            password_2: {
                validators: {
                        stringLength: {
                        min: 5,
                    },
                        notEmpty: {
                        message: 'Please confirm the new password.'
                    },
                    identical: {
                        field: 'password_1',
                        message: 'The confirm password does not match the new password.'
                    }
                }
            }
            }
        });
  $('#personalForm').bootstrapValidator({
        message: 'This value is invalid.',
        fields: {
            fullname: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please supply your first name'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your phone number'
                    },
                    phone: {
                        country: 'US',
                        message: 'Please supply a vaild phone number with area code'
                    }
                }
            },
            street: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please supply your street address'
                    }
                }
            },
            city: {
                validators: {
                     stringLength: {
                        min: 4,
                    },
                    notEmpty: {
                        message: 'Please supply your city'
                    }
                }
            },
            state: {
                validators: {
                    notEmpty: {
                        message: 'Please select your state'
                    }
                }
            },
            zip: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your zip code'
                    },
                    zipCode: {
                        country: 'US',
                        message: 'Please supply a vaild zip code'
                    }
                }
            }
            }
        });
  $('#newProductForm').bootstrapValidator({
        message: 'This value is invalid.',
        fields: {
            toyname: {
                validators: {
                        stringLength: {
                        min: 3
                    },
                        notEmpty: {
                        message: 'Please enter the product\'s name.'
                    }
                }
            },
            price: {
                validators: {
                    notEmpty: {
                        message: 'Please enter the price of the product.'
                    },
                    greaterThan: {
                        message: 'Please enter a valid amount.',
                        value: 0,
                        inclusice: true
                    }
                }
            },
            available: {
                validators: {
                     digits: {
                        message: 'Please enter numbers only.'
                    },
                    notEmpty: {
                        message: 'Please enter the quantity of the product.'
                    },
                    greaterThan: {
                        message: 'Quantity cannot be less than zero.',
                        value: 0,
                        inclusice: true
                    }
                }
            },
            category: {
                validators: {
                    notEmpty: {
                        message: 'Please select at least one category.'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: 'Please enter some description for your product.'
                    }
                }
            }
            }
        });
});

