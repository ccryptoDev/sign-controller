const slickFunction = function () {
  $('.slick')
    .on('init', () => {
      $('.slick-slide[data-slick-index="-2"]').addClass('lt2');
      $('.slick-slide[data-slick-index="-1"]').addClass('lt1');
      $('.slick-slide[data-slick-index="1"]').addClass('gt1');
      $('.slick-slide[data-slick-index="2"]').addClass('gt2');
  })
  .slick({
    
    centerMode: true,
    centerPadding: 0,
    // slidesToShow: 3,
    slidesToShow: 5,
    slidesToScroll: 5,
    responsive: [
      {
        breakpoint: 1440,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 5,
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  }).on('beforeChange', (event, slick, current, next) => {
    $('.slick-slide.gt2').removeClass('gt2');
    $('.slick-slide.gt1').removeClass('gt1');
    $('.slick-slide.lt1').removeClass('lt1');
    $('.slick-slide.lt2').removeClass('lt2');

    const lt2 = (current < next && current > 0) ? current - 1 : next - 2;
    const lt1 = (current < next && current > 0) ? current : next - 1;
    const gt1 = (current < next || next === 0) ? next + 1 : current;
    const gt2 = (current < next || next === 0) ? next + 2 : current + 1;

    $(`.slick-slide[data-slick-index="${lt2}"]`).addClass('lt2');
    $(`.slick-slide[data-slick-index="${lt1}"]`).addClass('lt1');
    $(`.slick-slide[data-slick-index="${gt1}"]`).addClass('gt1');
    $(`.slick-slide[data-slick-index="${gt2}"]`).addClass('gt2');

    // Clone processing when moving from 5 to 0
    if (current === 5 && next === 0) {
      $(`.slick-slide[data-slick-index="${current - 1}"]`).addClass('lt2');
      $(`.slick-slide[data-slick-index="${current}"]`).addClass('lt1');
      $(`.slick-slide[data-slick-index="${current + 2}"]`).addClass('gt1');
      $(`.slick-slide[data-slick-index="${current + 3}"]`).addClass('gt2');
    }

    // Clone processing when moving from 0 to 5
    if (current === 0 && next === 5) {
      $(`.slick-slide[data-slick-index="${current - 1}"]`).addClass('gt2');
      $(`.slick-slide[data-slick-index="${current}"]`).addClass('gt1');
      $(`.slick-slide[data-slick-index="${current - 2}"]`).addClass('lt1');
      $(`.slick-slide[data-slick-index="${current - 3}"]`).addClass('lt2');
    }

    firstIndex = next;

    if (firstSelectedImages.length > 0) {

      var name = firstSelectedImages[firstIndex].name;
      $("#information").val(name);

    } else {
        $("#information").val("");
    }

  });
}

const addClassFunction = function () {
  const thumbnails = document.querySelectorAll('.thumbnail-list span');
  
  thumbnails.forEach((thumbnail, index) => {
    thumbnail.addEventListener('click', () => {
      // console.log('Clicked thumbnail index:', index); index is secondIndex
      const id = secondSelectedImages[index].id;
      for (let i = 0; i < firstSelectedImages.length; i++) {
        if (firstSelectedImages[i].id === id) {
          
          firstIndex = i;
          $('.slick').slick('slickGoTo', i);

          break;

        }
      }
     
      secondIndex = index;

      if (secondSelectedImages.length > 0) {
          var name = secondSelectedImages[secondIndex].name;
          // .split(".bmp")[0].split("_").join(" ");
          $("#information").val(name);
      } else {
          $("#information").val("");
      }

    });
  });
}

document.addEventListener("DOMContentLoaded", function() {
  addClassFunction();
  slickFunction();
});