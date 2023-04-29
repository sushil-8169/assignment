// $(document).ready(function () {});

// $('[name="singUp"]').on("click", function (e) {
//   alert();
//   e.preventDefault();
//   let button = $(this);
//   let username = $('[name="email"]').val();
//   let password = $('[name="password"]').val();
//   $.ajax({
//     url: "http://localhost:8888/user",
//     method: "POST",
//     timeout: 0,
//     headers: {
//       "Content-Type": "application/json",
//     },
//     data: JSON.stringify({
//       username: username,
//       password: password,
//     }),
//     beforeSend: function () {},
//     success: function (data) {
//       if (($data = JSON.parse(data))) {
//         if ($data.error == 0 && $data.success == true) {
//           sessionStorage.setItem("email", $data.data["emailID"]);
//           sessionStorage.setItem("username", $data.data["accessToken"]);
//           sessionStorage.setItem("userType", "0");
//           if (sessionStorage.getItem("userType") == 0) {
//             window.location.href = "records.php";
//           }
//         }
//       }
//     },
//     error: function (jqXHR, textStatus, errorTh) {},
//   });
// });

// var settings = {
//   url: "http://localhost:8888/user",
//   method: "POST",
//   timeout: 0,
//   headers: {
//     "X-API-USER": "sushilgupta.2712@gmail.com",
//     "X-API-KEY": "fb8afadf4d04040a6c24a51d7d4f00864325",
//     "Content-Type": "application/json",
//   },
//   data: JSON.stringify({
//     username: "sushilgupta.2712@gmail.com",
//     password: "12345",
//   }),
// };

// $.ajax(settings).done(function (response) {
//   console.log(response);
// });
