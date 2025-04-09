const slickFunction = function () {
  let lastClickTime = 0;
  $('.slick')
    .on('init', function (event, slick) {
      $('.slick-slide[data-slick-index="-2"]').addClass('lt2');
      $('.slick-slide[data-slick-index="-1"]').addClass('lt1');
      $('.slick-slide[data-slick-index="1"]').addClass('gt1');
      $('.slick-slide[data-slick-index="2"]').addClass('gt2');

      if (slick.slideCount <= slick.options.slidesToShow) {
        setTimeout(() => {
          $('.slick .slick-slide').each(function () {
            $(this).attr('aria-hidden', 'false');
          });
        }, 0); // 0ms delay = next tick after Slick's DOM ops
      }
  })
  .slick({

    centerMode: true,
    centerPadding: 0,
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
          slidesToShow: 5,
          slidesToScroll: 5
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
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

    // highlisten the same item for thumbnail list
    highlightSelectedItem(next);

    // dislay the name of selected Image
    displayMessageName(firstSelectedImages);

  });

  $('.slick').on('click', '.slick-slide', function() {
    const slickInstance = $('.slick').slick('getSlick');
    if (slickInstance.slideCount <= slickInstance.options.slidesToShow) {
      $('.slick .slick-slide').removeClass('slick-current');
      $(this).addClass('slick-current');
    }
    handleSlideClick($(this));
  });

  // Bind double-click event to slides
  // $('.slick').on('dblclick', '.slick-slide', function() {
  //   console.log('Double-clicked slide:', $(this).attr('data-slick-index'));
  // });
}

function handleSlideClick($slide) {
    messageIds = [];
    var slideIndex = $slide.attr('data-slick-index');
    var slide_no = $slide.find('span img').data('slide-no');
    firstIndex = slide_no;

    $slide.find("span img").each(function () {
      messageIds.push($(this).attr("data-id"));
    });

    // move slider to the clicked one
    $('.slick').slick('slickGoTo', slideIndex);
}

const highlightSelectedItem = function(index) {
  if (document.querySelectorAll('#thumbnail-list li').length) {
    document.querySelectorAll('#thumbnail-list li').forEach(function(item) {
      item.classList.remove('active');
    });
    const selectedItem = document.querySelectorAll('#thumbnail-list li')[index];
    selectedItem.classList.add('active');
  }
}

const displayMessageName = function(imageList) {
  if (imageList.length > 0) {
    var name = imageList[firstIndex].name;
    $("#information").val(name);
  } else {
    $("#information").val("");
  }
}

const addClassFunction = function () {
  const thumbnails = document.querySelectorAll('.thumbnail-list span');

  thumbnails.forEach((thumbnail, index) => {
    thumbnail.addEventListener('click', () => {
      // console.log('Clicked thumbnail index:', index); index is secondIndex
      const id = secondSelectedImages[index].id;

      // highlighten the selected Item in a list
      highlightSelectedItem(index);

      for (let i = 0; i < firstSelectedImages.length; i++) {
        if (firstSelectedImages[i].id === id) {

          firstIndex = i;
          $('.slick').slick('slickGoTo', i);

          break;

        }
      }

      firstIndex = index;
      // display the selected Image
      displayMessageName(secondSelectedImages);

    });
  });
}

document.addEventListener("DOMContentLoaded", function() {
  addClassFunction();
//   slickFunction();
});