/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Changer la classe l'id courante a current
 * @param {int} valeurId la valeur de l'id
 * @returns {undefined}
 */
function changerPageCourante(valeurId){
    $('.menuH li').each(function(e){
        if($(this).attr('id') === valeurId){
            $(this).attr('class', 'current');
        }else{
             $(this).attr('class', '');
        }
    });
}