function loadUser() {
  $.ajax({
    url: "backend/all-user.php",
    method: "POST",
    data: {
      getUser: true,
    },
    beforeSend: function () {},
    success: function (data) {
      console.log(data);
      if (($data = JSON.parse(data))) {
        if ($data.error == 0 && $data.success == true) {
          let dataAppend = "";
          $i = 0;
          $.each($data.data, function (index, value) {
            $i++;
            dataAppend +=
              "<tr><td>" +
              $i +
              "</td><td>" +
              $data.data[index].name +
              "</td><td>" +
              $data.data[index].email +
              "</td><td><a href='user-transaction.php?id=" +
              $data.data[index].id +
              "'><button class=' btn btn-info'>View Transaction</button></a></td></tr>";
          });
          $("#userTable").html(dataAppend);
        }
      }
    },
    error: function (jqXHR, textStatus, errorTh) {},
  });
}

loadUser();
