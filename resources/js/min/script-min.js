!function(){function t(){e(),o(),a(),n()}function n(){0!=r.text()&&s.val(r.text())}function e(){i.on("input",function(){v=0;for(var t=0;t<i.length;t++){var n=i[t].value,e=$(i[t]).closest("div").find(".prix__prix").text(),o=n*e;v+=o}v=Math.round(100*v)/100,r.text(v),s.val(v)})}function o(){v=0;for(var t=0;t<i.length;t++){var n=i[t].value,e=$(i[t]).closest("div").find(".prix__prix").text(),o=n*e;v+=o}v=Math.round(100*v)/100,r.text(v)}function a(){l.on("change",function(){console.log(l.val()),"new"==l.val()?(f.addClass("show"),u.addClass("hide")):(f.removeClass("show"),u.removeClass("hide"))})}var i=$(".fut--data"),l=$(".select--new"),r=$(".total__number"),v=0,s=$("#commandetotal"),f=$(".form--new-event"),u=$(".form--know-event");t()}();