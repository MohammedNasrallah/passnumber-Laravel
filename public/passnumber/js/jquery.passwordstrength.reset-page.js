/** 
 * Took the idea from the script and completely reinvented according to my logic.
 * @Developer   Delowar [http://delowar.me]
 * 
 * 
 * @author      ShevAbam (http://www.shevarezo.fr)
 * @date        11 june 2014
 * @version     1.0
 * 
 */

(function($){
    
    $.fn.passwordstrength = function(options) {

        return this.each(function(){
            
            var $this = $(this);
            var reachedtop;
            var yellow;
            var fix7;
            // HTML


            $this.on('focus input', function() {
                var value = $this.val();
                // console.log(value)
                $('#passwordstrength-wrap').fadeIn(400);

                if (value.length < 1)
                {
                    $('.condition.maxrange').removeClass('valid');
                    $('.condition.maxrange').removeClass('invalid');
                    $('.condition.digit').removeClass('valid');
                    $('.condition.digit').removeClass('invalid');
                    $('.condition.zero').removeClass('valid');
                    $('.condition.zero').removeClass('invalid');

                }
                if (value.length < 2)
                {
                    $('.condition.digit-two').removeClass('valid');
                    $('.condition.digit-two').removeClass('invalid');
                }
                // password length digit one
                if (value.length >=1)
                {
                    // Only Number 0-4
                    var firstval = value.slice(0,1);
                    // console.log(firstval)
                    if (firstval.match(/^(1|2|3|4|0)*$/))
                    {
                        $('.condition.digit').removeClass('invalid');
                        $('.condition.digit').addClass('valid');
                    }
                    else
                    {
                        $('.condition.digit').addClass('invalid');
                    }
                }
                // Digit 2/3
                if (value.length >=2 && value.length <=3)
                {
                    // Only Number 0-4
                    var secondVal = value.substring(1,value.length);
                    // console.log(secondVal)
                    if (secondVal.match(/^(1|2|3|4|0)*$/))
                        {
                            $('.condition.digit-two').removeClass('invalid');
                            $('.condition.digit-two').addClass('valid');
                        }
                    else
                    {
                        $('.condition.digit-two').removeClass('valid');
                        $('.condition.digit-two').addClass('invalid');
                    }
                }   

                // Maximum
                 // Length 
                if (value.length == 4)
                {
                    $('.condition.maxrange').removeClass('invalid');
                    $('.condition.maxrange').addClass('valid');
                    reachedtop = 4;
                    // console.log(reachedtop)
                }
                else
                {
                    $('.condition.maxrange').removeClass('valid');
                }
                if (value.length < 4 && reachedtop==4)
                {
                    $('.condition.maxrange').removeClass('valid');
                    $('.condition.maxrange').addClass('invalid');
                }
                else
                    $('.condition.maxrange').removeClass('invalid');
                    
                if (value.length > 0)
                {
                    // only accepts 0-4
                    if (value.match(/^(1|2|3|4|0)*$/))
                    {
                        $('.condition.limited').removeClass('invalid');
                        $('.condition.limited').addClass('valid');
                    }
                    else
                    {
                        $('.condition.limited').removeClass('valid');
                        $('.condition.limited').addClass('invalid');
                    }


                    // Only Number 0 once
                    if (value.match(/0/gi))
                    {
                        $('.condition.zero').removeClass('invalid');
                        $('.condition.zero').addClass('valid');
                    }
                    else
                    {
                        $('.condition.zero').removeClass('valid');
                        $('.condition.zero').addClass('invalid');
                    }
                        

                    if (value.match(/0/gi).length>1)
                    {
                        $('.condition.zero').removeClass('valid');
                        $('.condition.zero').addClass('invalid');
                    }
                    
                }
                
            });

        });
    }

})(jQuery);