$(document).ready(function () {});

function loadTransactions() {
  const urlParams = new URLSearchParams(window.location.search);
  const param = urlParams.get("id");
  $.ajax({
    url: "backend/user-transaction.php",
    method: "POST",
    data: {
      id: param,
      getTransaction: true,
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
              $data.data[index].deposit +
              "</td><td>" +
              $data.data[index].withdraw +
              "</td><td>" +
              $data.data[index].totalAmount +
              "</td><td>" +
              $data.data[index].createdOn +
              "</td></tr>";
          });
          $("#accountTable").html(dataAppend);
        }
      }
    },
    error: function (jqXHR, textStatus, errorTh) {},
  });
}

loadTransactions();
