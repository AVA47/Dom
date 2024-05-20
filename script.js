// function getVals(){
//     // Get slider values
//     var parent = this.parentNode;
//     var slides = parent.getElementsByTagName("input");
//       var slide1 = parseFloat( slides[0].value );
//       var slide2 = parseFloat( slides[1].value );
//     // Neither slider will clip the other, so make sure we determine which is larger
//     if( slide1 > slide2 ){ var tmp = slide2; slide2 = slide1; slide1 = tmp; }

//     var displayElement = parent.getElementsByClassName("rangeValues")[0];
//         displayElement.innerHTML = "$ " + slide1 + "k - $" + slide2 + "k";
//   }

//   window.onload = function(){
//     // Initialize Sliders
//     var sliderSections = document.getElementsByClassName("range-slider");
//         for( var x = 0; x < sliderSections.length; x++ ){
//           var sliders = sliderSections[x].getElementsByTagName("input");
//           for( var y = 0; y < sliders.length; y++ ){
//             if( sliders[y].type ==="range" ){
//               sliders[y].oninput = getVals;
//               // Manually trigger event first time to display values
//               sliders[y].oninput();
//             }
//           }
//         }
//   }

AOS.init();


const rangeSlider = document.getElementById('slider-track');


if (rangeSlider) {
  noUiSlider.create(rangeSlider, {
    start: [0, 8000],
    connect: true,
    step: 50,
    range: {
      'min': [0],
      'max': [8000]
    }
  });

  const input0 = document.getElementById('range_left');
  const input1 = document.getElementById('range_right');

  const inputs = [input0, input1];
  rangeSlider.noUiSlider.on('update', function (values, handle) {
    inputs[handle].value = Math.round(values[handle]);
  });
  const setRangeSlider = (i, value) => {
    let arr = [null, null];
    arr[i] = value;
    rangeSlider.noUiSlider.set(arr);
  };

  inputs.forEach((el, index) => {
    el.addEventListener('change', (e) => {
      setRangeSlider(index, e.currentTarget.value);
    });
  })

}
