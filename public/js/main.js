$(function(){
	$("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        transitionEffectSpeed: 300,
        labels: {
            next: "Continue",
            previous: "Back",
            finish: 'Register'
        },
        onStepChanging: function (event, currentIndex, newIndex) { 
            if ( newIndex >= 1 ) {
                $('.steps ul li:first-child a img').attr('src','images/step-1.png');
            } else {
                $('.steps ul li:first-child a img').attr('src','images/step-1-active.png');
            }

            if ( newIndex === 1 ) {
                $('.steps ul li:nth-child(2) a img').attr('src','images/step-2-active.png');
                $('.actions ul').addClass('step-2');
            } else {
                $('.steps ul li:nth-child(2) a img').attr('src','images/step-2.png');
                $('.actions ul').removeClass('step-2');
            }

            
            return true; 
        }
    });
    // Custom Button Jquery Steps
    $('.forward').click(function(){
    	$("#wizard").steps('next');
    })
    $('.backward').click(function(){
        $("#wizard").steps('previous');
    })
    // Create Steps Image
    $('.steps ul li:first-child').append('<img src="images/step-arrow.png" alt="" class="step-arrow">').find('a').append('<img src="images/step-1-active.png" alt=""> ').append('<span class="step-order">Step 01</span>');
    $('.steps ul li:last-child a').append('<img src="images/step-2.png" alt="">').append('<span class="step-order">Step 02</span>');
    // Count input 

    $('.actions').find('a').each(function(){
        let target = $(this).attr('href');

        if(target == '#finish') {
            let input = '<button type="submit" class="btn btn-primary" role="menuitem">Register</button>'
            let parent = $(this).parent()
            $(this).hide()
            parent.append(input)
        }
    });
})
