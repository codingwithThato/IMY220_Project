// // Function to calculate and update the scroll progress
// const updateProgressBar = () => {
//     const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
//     const scrollTop = window.scrollY;
//     const progress = (scrollTop / scrollHeight) * 100;
//     document.getElementById("progress-bar").value = progress;
//     // console.log("i've loaded without errors");
// }
 
// // Attach the updateProgressBar function to the scroll event
// window.addEventListener("scroll", updateProgressBar);

// // $(document).ready(() => { 
//     updateProgressBar();
// // });
 

const scrollProgress = document.getElementById('progress-bar');
const height =
  document.documentElement.scrollHeight - document.documentElement.clientHeight;

window.addEventListener('scroll', () => {
  const scrollTop =
    document.body.scrollTop || document.documentElement.scrollTop;
  scrollProgress.style.width = `${(scrollTop / height) * 100}%`;
});