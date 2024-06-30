$(document).ready(function () {
  // get quantity for purchasing order
  $("#selected-product").on("change", function () {
    var id = $(this).val();
    $.ajax({
      type: "GET",
      url: `./apis/get_product_details?id=${id}`,
      contentType: false,
      processData: false,
      cache: false,
      success: function (resp, textStatus, xhr) {
        let alertClass;
        if (xhr.status === 201) {
          alertClass = "alert-success";
        } else if (xhr.status === 200) {
          alertClass = "alert-success";
          $("#material-quantity").val(resp?.data[0]?.quantity);
          $("#material-unit").val(resp?.data[0]?.unit);
          $("#material-department").val(resp?.data[0]?.category_name);
        } else {
          alertClass = "alert-warning";
        }

        // Reset the form
        // $("#myForm")[0].reset();
      },
      error: function (xhr, status, error) {
        let message = "";
        // let response = xhr?.responseText;
        message = xhr.responseJSON?.message || "An unexpected error occurred.";
      },
    });
  });

  // Create PO
  // Add products for pos
  var products = [];

  $("#add-more-product").click(function (e) {
    e.preventDefault();
    var selectedProductId = $(".product_id option:selected").val();
    var selectedProductText = $(".product_id option:selected").text().trim();
    var materialQuantity = $(".material-quantity").val();
    var requirement = $(".issue").val();
    var department = $(".material-department").val();
    var unit = $(".material-unit").val();

    // Check if product is selected
    if (!selectedProductId) {
      // demo.showNotification("bottom", "right", "Please select product");
      notify.showWarningNotification(
        "bottom",
        "right",
        "Please select product"
      );
      return;
    }

    // Check if requirement is filled
    if (!requirement) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Requirement cannot be empty"
      );
      return;
    }

    // Check for duplicate products
    for (var i = 0; i < products.length; i++) {
      if (products[i].id === selectedProductId) {
        notify.showWarningNotification(
          "bottom",
          "right",
          "Product is already in PO List"
        );
        return;
      }
    }

    var product = {
      id: selectedProductId,
      materialName: selectedProductText,
      materialQuantity: materialQuantity,
      requirement: requirement,
      department: department,
      unit: unit,
    };

    products.push(product);

    // Clear the form
    $(".product_id").prop("selectedIndex", 0);
    $(".material-quantity").val("");
    $(".issue").val("");
    $(".material-department").val("");
    $(".material-unit").val("");

    $(".product-table-body").empty();

    function genetrateTableBodyHTML(product) {
      return `<tr>
                                                <td>${product?.materialName}</td>
                                                <td>${product?.department}</td>
                                                <td>${product?.unit}</td>
                                                <td>${product?.materialQuantity}</td>
                                                <td>${product?.requirement}</td>
                                            </tr>`;
    }

    products.forEach(function (product) {
      var tableBodyHTML = genetrateTableBodyHTML(product);
      $(".product-table-body").append(tableBodyHTML);
    });

    if (products.length > 0) {
      $(".product-table-container").css("display", "block");
    }
  });

  // Po Submit
  $("#po-submit").on("click", function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: `./apis/create_po`,
      contentType: "application/json; charset=UTF-8",
      data: JSON.stringify(products),
      cache: false,
      success: function (resp, textStatus, xhr) {
        if (xhr.status === 201) {
          notify.showSuccessNotification("bottom", "right", resp?.message);
        } else if (xhr.status === 200) {
          notify.showSuccessNotification("bottom", "right", resp?.message);
        } else {
          notify.showWarningNotification("bottom", "right", resp?.message);
        }
      },
      error: function (xhr, status, error) {
        let message = "";
        // let response = xhr?.responseText;
        message = xhr.responseJSON?.message || "An unexpected error occurred.";
        notify.showWarningNotification("bottom", "right", message);
      },
    });
  });

  // Accept PO
  $("#confirm-accept-po").on("click", function () {
    var id = $(this).data("id");
    console.log(id);
    $.ajax({
      type: "GET",
      url: `./apis/purchasing_order_accept?id=${id}`,
      contentType: "application/json; charset=UTF-8",
      cache: false,
      success: function (resp, textStatus, xhr) {
        let alertClass;
        if (xhr.status === 201) {
          $("#acceptPo").modal("hide");
          notify.showSuccessNotification("bottom", "right", resp?.message);
        } else if (xhr.status === 200) {
          $("#acceptPo").modal("hide");
          notify.showSuccessNotification("bottom", "right", resp?.message);
        } else {
          $("#acceptPo").modal("hide");
          notify.showWarningNotification("bottom", "right", resp?.message);
        }
      },
      error: function (xhr, status, error) {
        let message = "";
        message = xhr.responseJSON?.message || "An unexpected error occurred.";

        $("#acceptPo").modal("hide");
        notify.showWarningNotification("bottom", "right", message);
      },
    });
  });

  // Confirm Add Quantity
  $("#confirm-add-quantity").on("click", function () {
    var id = $(this).data("id");
    $.ajax({
      type: "GET",
      url: `./apis/change_purchasing_orders?id=${id}`,
      contentType: "application/json; charset=UTF-8",
      cache: false,
      success: function (resp, textStatus, xhr) {
        if (xhr.status === 201) {
          $("#addQuantity").modal("hide");
          notify.showSuccessNotification("bottom", "right", resp?.message);
        } else if (xhr.status === 200) {
          $("#addQuantity").modal("hide");
          notify.showSuccessNotification("bottom", "right", resp?.message);
          setTimeout(() => {
            window.location.reload();
          }, 3000);
        } else {
          $("#addQuantity").modal("hide");
          notify.showWarningNotification("bottom", "right", resp?.message);
        }
      },
      error: function (xhr, status, error) {
        let message = "";
        message = xhr.responseJSON?.message || "An unexpected error occurred.";

        switch (xhr.status) {
          case 400:
            message = message;
            break;
          case 401:
            message = message;
            break;
          case 403:
            message = message;
            break;
          case 404:
            message = message;
            break;
          case 409:
            message = message;
            break;
          case 500:
            message = message;
            break;
          case 405:
            message = message;
            break;
          default:
            message = "An unexpected error occurred: " + message;
        }

        $("#acceptPo").modal("hide");
        notify.showWarningNotification("bottom", "right", message);
      },
    });
  });

  // Autocomplete input for orders company name
  // var availableTags = [
  //   "ActionScript",
  //   "AppleScript",
  //   "Asp",
  //   "BASIC",
  //   "C",
  //   "C++",
  //   "Clojure",
  //   "COBOL",
  //   "ColdFusion",
  //   "Erlang",
  //   "Fortran",
  //   "Groovy",
  //   "Haskell",
  //   "Java",
  //   "JavaScript",
  //   "Lisp",
  //   "Perl",
  //   "PHP",
  //   "Python",
  //   "Ruby",
  //   "Scala",
  //   "Scheme",
  // ];
  // $("#tags").autocomplete({
  //   source: availableTags,
  // });

  function getAutocompleteData() {
    var dataChange = "orders";
    $.ajax({
      url: `./apis/get_autocomplete_data?data-change=${dataChange}`,
      method: "GET",
      contentType: "application/json; charset=UTF-8",
      cache: false,
      dataType: "json",
      success: function (resp, textStatus, xhr) {
        if (xhr.status === 200) {
          companyData = resp.data;
          var companyNames = companyData.map(function (item) {
            return item.company_name;
          });

          // Initialize autocomplete with the company names
          $("#tags").autocomplete({
            source: companyNames,
            select: function (event, ui) {
              var selectedCompany = ui.item.value;
              var selectedData = companyData.find(function (item) {
                return item.company_name === selectedCompany;
              });

              if (selectedData) {
                $("#company-address").val(selectedData.company_address);
                $("#gstin").val(selectedData.gstin);
              }
            },
          });
        }
      },
      error: function (xhr, status, error) {
        let message = "";
        message = xhr.responseJSON?.message || "An unexpected error occurred.";
        console.log(message);
      },
    });
  }

  getAutocompleteData();

  function getAutocompleteDataTransfer() {
    var dataChange = "transfers";
    $.ajax({
      url: `./apis/get_autocomplete_data?data-change=${dataChange}`,
      method: "GET",
      contentType: "application/json; charset=UTF-8",
      cache: false,
      dataType: "json",
      success: function (resp, textStatus, xhr) {
        if (xhr.status === 200) {
          companyData = resp.data;
          var partyNames = companyData.map(function (item) {
            return item.party_name;
          });

          // companyNames = ["party name"];
          // Initialize autocomplete with the company names
          $("#party-name").autocomplete({
            source: partyNames,
            select: function (event, ui) {
              var selectedParty = ui.item.value;
              var selectedPartyData = companyData.find(function (item) {
                return item.party_name === selectedParty;
              });

              if (selectedPartyData) {
                $("#party-address").val(selectedPartyData.party_address);
                $("#gstin").val(selectedPartyData.gstin);
              }
            },
          });
        }
      },
      error: function (xhr, status, error) {
        let message = "";
        message = xhr.responseJSON?.message || "An unexpected error occurred.";
        console.log(message);
      },
    });
  }

  // getAutocompleteDataTransfer();

  // Add product for order
  var productsorder = [];
  $("#add-order-product").click(function (e) {
    e.preventDefault();
    var selectedProductId = $(".product_id option:selected").val();
    var selectedProductText = $(".product_id option:selected").text().trim();
    var hsnCode = $(".hsn_code").val();
    var quantity = $(".quantity").val();
    var rate = $(".rate").val();
    var per = $(".per").val();
    var amount = $(".amount").val();
    var cgst = $(".cgst").val();
    var sgst = $(".sgst").val();
    var igst = $(".igst").val();
    var product_total = $(".product_total").val();

    if (!selectedProductId) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Please select product"
      );
      return;
    }
    if (!hsnCode) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "HSN code cannot be empty"
      );
      return;
    }
    if (!quantity) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Quantity cannot be empty"
      );
      return;
    }
    if (!rate) {
      notify.showWarningNotification("bottom", "right", "Rate cannot be empty");
      return;
    }
    if (!per) {
      notify.showWarningNotification("bottom", "right", "Per cannot be empty");
      return;
    }
    if (!amount) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Amount cannot be empty"
      );
      return;
    }
    if (!product_total) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Total cannot be empty"
      );
      return;
    }

    // Check for duplicate products
    for (var i = 0; i < productsorder.length; i++) {
      if (productsorder[i].productId === selectedProductId) {
        notify.showWarningNotification(
          "bottom",
          "right",
          "Product is already in Product List"
        );
        return;
      }
    }

    var products = {
      productId: selectedProductId,
      materialName: selectedProductText,
      hsnCode: hsnCode,
      quantity: quantity,
      rate: rate,
      per: per,
      amount: amount,
      cgst: cgst,
      sgst: sgst,
      igst: igst,
      product_total: product_total,
    };

    productsorder.push(products);

    var total = calculateTotal(productsorder);
    $(".total-amount").text(total.toString());

    // Clear the form
    $(".product_id").prop("selectedIndex", 0);
    $(".material-department").val("");
    $(".material-unit").val("");
    $(".hsn_code").val("");
    // $(".hsn_code").val("");
    $(".quantity").val("");
    $(".rate").val("");
    $(".per").val("");
    $(".amount").val("");
    $(".cgst").val("");
    $(".sgst").val("");
    $(".igst").val("");
    $(".product_total").val("");
    $(".product-order-table-body").empty();

    function genetrateTableBodyHTML(product) {
      return `<tr>
                                                <td>${product?.materialName}</td>
                                                <td>${product?.hsnCode}</td>
                                                <td>${product?.quantity}</td>
                                                <td>${product?.rate}</td>
                                                <td>${product?.per}</td>
                                                <td>${product?.amount}</td>
                                                <td>${product?.cgst}</td>
                                                <td>${product?.sgst}</td>
                                                <td>${product?.igst}</td>
                                                <td>${product?.product_total}</td>
                                            </tr>`;
    }

    productsorder.forEach(function (product) {
      var tableBodyHTML = genetrateTableBodyHTML(product);
      $(".product-order-table-body").append(tableBodyHTML);
    });

    if (productsorder.length > 0) {
      $(".product-table-container").css("display", "block");
    }
  });

  // Order submit
  $("#order-submit").on("click", function (e) {
    e.preventDefault();
    var companyName = $(".company-name").val();
    var companyAddress = $(".company-address").val();
    var gstin = $(".gstin").val();
    var invoiceNo = $(".invoice-no").val();
    var date = $(".date").val();
    var destination = $(".destination").val();
    var vehicleNo = $(".vehicle-no").val();
    var total = $(".total-amount").text();
    var orderType = $(this).data("order-type");
    var inOut = $(this).data("in-out");

    if (!companyName) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Company name cannot be empty"
      );
      return;
    }
    if (!companyAddress) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Company Address cannot be empty"
      );
      return;
    }
    if (!gstin) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "GSTIN cannot be empty"
      );
      return;
    }
    if (!invoiceNo) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Invoice number be empty"
      );
      return;
    }
    if (!date) {
      notify.showWarningNotification("bottom", "right", "Date cannot be empty");
      return;
    }
    if (!destination) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Destination cannot be empty"
      );
      return;
    }
    if (!vehicleNo) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Vehicle no cannot be empty"
      );
      return;
    }
    if (productsorder.length === 0) {
      notify.showWarningNotification("bottom", "right", "Please add product");
      return;
    }
    if (!total) {
      notify.showWarningNotification("bottom", "right", "Total is empty");
      return;
    }

    // var total =
    //   parseFloat(total) +
    //   (parseFloat(cgst) || 0) +
    //   (parseFloat(igst) || 0) +
    //   (parseFloat(sgst) || 0);

    var order = [
      {
        companyName: companyName,
        companyAddress: companyAddress,
        gstin: gstin,
        invoiceNo: invoiceNo,
        date: date,
        destination: destination,
        vehicleNo: vehicleNo,
        orderType: orderType,
        inOut: inOut,
        total: total,
      },
    ];

    const data = {
      order: order,
      products: productsorder,
    };

    $.ajax({
      type: "POST",
      url: `./apis/order`,
      contentType: "application/json; charset=UTF-8",
      data: JSON.stringify(data),
      cache: false,
      success: function (resp, textStatus, xhr) {
        if (xhr.status === 201) {
          notify.showSuccessNotification("bottom", "right", resp?.message);
        } else if (xhr.status === 200) {
          notify.showSuccessNotification("bottom", "right", resp?.message);
        } else {
          notify.showWarningNotification("bottom", "right", resp?.message);
        }
      },
      error: function (xhr, status, error) {
        let message = "";
        message = xhr.responseJSON?.message || "An unexpected error occurred.";
        notify.showWarningNotification("bottom", "right", message);
      },
    });
  });

  // Function to calculate the total amount including taxes for all products
  function calculateTotal(products) {
    var totalAmount = 0;
    products.forEach(function (product) {
      totalAmount +=
        // (parseFloat(product.amount) || 0) +
        // (parseFloat(product.cgst) || 0) +
        // (parseFloat(product.igst) || 0) +
        // (parseFloat(product.sgst) || 0) +
        parseFloat(product.product_total) || 0;
    });
    return totalAmount;
  }

  // Function to calculate the total amount for all products in transfer
  function calculateTotalTransfer(products) {
    var totalAmount = 0;
    products.forEach(function (product) {
      totalAmount += parseFloat(product.amount) || 0;
    });
    return totalAmount;
  }

  // Add product for transfer
  var productstransfer = [];
  $("#add-transfer-product").click(function (e) {
    e.preventDefault();
    var selectedProductId = $(".product_id option:selected").val();
    var selectedProductText = $(".product_id option:selected").text().trim();
    var hsnCode = $(".hsn_code").val();
    var quantity = $(".quantity").val();
    var rate = $(".rate").val();
    var amount = $(".amount").val();

    if (!selectedProductId) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Please select product"
      );
      return;
    }
    if (!hsnCode) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "HSN code cannot be empty"
      );
      return;
    }
    if (!quantity) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Quantity cannot be empty"
      );
      return;
    }
    if (!rate) {
      notify.showWarningNotification("bottom", "right", "Rate cannot be empty");
      return;
    }
    if (!amount) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Amount cannot be empty"
      );
      return;
    }

    // Check for duplicate products
    for (var i = 0; i < productstransfer.length; i++) {
      if (productstransfer[i].productId === selectedProductId) {
        notify.showWarningNotification(
          "bottom",
          "right",
          "Product is already in Product List"
        );
        return;
      }
    }

    var products = {
      productId: selectedProductId,
      materialName: selectedProductText,
      hsnCode: hsnCode,
      quantity: quantity,
      rate: rate,
      amount: amount,
    };

    productstransfer.push(products);

    var total = calculateTotalTransfer(productstransfer);
    $(".total-amount").text(total.toString());

    // Clear the form
    $(".product_id").prop("selectedIndex", 0);
    $(".material-department").val("");
    $(".material-unit").val("");
    $(".material-quantity").val("");
    $(".hsn_code").val("");
    $(".quantity").val("");
    $(".rate").val("");
    $(".amount").val("");

    $(".product-transfer-table-body").empty();

    function genetrateTableBodyHTML(product) {
      return `<tr>
                                                <td>${product?.materialName}</td>
                                                <td>${product?.hsnCode}</td>
                                                <td>${product?.quantity}</td>
                                                <td>${product?.rate}</td>
                                                <td>${product?.amount}</td>
                                            </tr>`;
    }

    productstransfer.forEach(function (product) {
      console.log(product);
      var tableBodyHTML = genetrateTableBodyHTML(product);
      $(".product-transfer-table-body").append(tableBodyHTML);
    });

    if (productstransfer.length > 0) {
      $(".product-table-container").css("display", "block");
    }

    console.log(productstransfer);
  });

  // Transfer submit
  $("#transfer-submit").on("click", function (e) {
    e.preventDefault();
    var companyName = $(".company-name").val();
    var companyAddress = $(".company-address").val();
    var partyName = $(".party-name").val();
    var partyAddress = $(".party-address").val();
    var gstin = $(".gstin").val();
    var challanNo = $(".challan-no").val();
    var challanDate = $(".challan-date").val();
    var transportName = $(".transport-name").val();
    var vehicleNo = $(".vehicle-no").val();
    var total = $(".total-amount").text();
    var orderType = $(this).data("order-type");
    var inOut = $(this).data("in-out");

    if (!companyName) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Company name cannot be empty"
      );
      return;
    }
    if (!companyAddress) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Company Address cannot be empty"
      );
      return;
    }
    if (!partyName) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Party name cannot be empty"
      );
      return;
    }
    if (!challanNo) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Challan no cannot be empty"
      );
      return;
    }
    if (!partyAddress) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Party Address cannot be empty"
      );
      return;
    }
    if (!gstin) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "GSTIN cannot be empty"
      );
      return;
    }
    if (!challanDate) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Challan Date cannot be empty"
      );
      return;
    }
    if (!transportName) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Transport Name cannot be empty"
      );
      return;
    }
    if (!vehicleNo) {
      notify.showWarningNotification(
        "bottom",
        "right",
        "Vehicle No. cannot be empty"
      );
      return;
    }

    if (productstransfer.length === 0) {
      notify.showWarningNotification("bottom", "right", "Please add product");
      return;
    }

    if (!total) {
      notify.showWarningNotification("bottom", "right", "Total is empty");
      return;
    }

    var transfers = [
      {
        companyName: companyName,
        companyAddress: companyAddress,
        partyName: partyName,
        partyAddress: partyAddress,
        gstin: gstin,
        challanNo: challanNo,
        challanDate: challanDate,
        transportName: transportName,
        vehicleNo: vehicleNo,
        orderType: orderType,
        inOut: inOut,
        total: total,
      },
    ];

    const data = {
      transfer: transfers,
      productstransfer: productstransfer,
    };

    $.ajax({
      type: "POST",
      url: `./apis/transfer`,
      contentType: "application/json; charset=UTF-8",
      data: JSON.stringify(data),
      cache: false,
      success: function (resp, textStatus, xhr) {
        if (xhr.status === 201) {
          notify.showSuccessNotification("bottom", "right", resp?.message);
        } else if (xhr.status === 200) {
          notify.showSuccessNotification("bottom", "right", resp?.message);
        } else {
          notify.showWarningNotification("bottom", "right", resp?.message);
        }
      },
      error: function (xhr, status, error) {
        let message = "";
        message = xhr.responseJSON?.message || "An unexpected error occurred.";
        notify.showWarningNotification("bottom", "right", message);
      },
    });
  });

  // Change Quantity Orders
  $("#change-quantity-order").on("click", function () {
    var id = $(this).data("id");
    var change = $(this).data("change");
    $.ajax({
      type: "GET",
      url: `./apis/order_change_quantity?id=${id}&data-change=${change}`,
      contentType: false,
      processData: false,
      cache: false,
      success: function (resp, textStatus, xhr) {
        if (xhr.status === 201) {
          $("#changeConfirmation").modal("hide");
          notify.showSuccessNotification("bottom", "right", resp?.message);
        } else if (xhr.status === 200) {
          $("#changeConfirmation").modal("hide");
          notify.showSuccessNotification("bottom", "right", resp?.message);
          setTimeout(() => {
            window.location.reload();
          }, 500);
        } else {
          $("#changeConfirmation").modal("hide");
          notify.showWarningNotification("bottom", "right", resp?.message);
        }
      },
      error: function (xhr, status, error) {
        let message = "";
        message = xhr.responseJSON?.message || "An unexpected error occurred.";
        statusS = xhr.status;
        $("#changeConfirmation").modal("hide");
        notify.showWarningNotification("bottom", "right", message);
      },
    });
  });

  // Change Quantity Transfer
  $("#change-quantity-transfer").on("click", function () {
    var id = $(this).data("id");
    var change = $(this).data("change");
    $.ajax({
      type: "GET",
      url: `./apis/transfer_change_quantity?id=${id}&data-change=${change}`,
      contentType: false,
      processData: false,
      cache: false,
      success: function (resp, textStatus, xhr) {
        if (xhr.status === 201) {
          $("#changeConfirmation").modal("hide");
          notify.showSuccessNotification("bottom", "right", resp?.message);
        } else if (xhr.status === 200) {
          $("#changeConfirmation").modal("hide");
          notify.showSuccessNotification("bottom", "right", resp?.message);
          setTimeout(() => {
            window.location.reload();
          }, 500);
        } else {
          $("#changeConfirmation").modal("hide");
          notify.showWarningNotification("bottom", "right", resp?.message);
        }
      },
      error: function (xhr, status, error) {
        let message = "";
        message = xhr.responseJSON?.message || "An unexpected error occurred.";
        statusS = xhr.status;
        $("#changeConfirmation").modal("hide");
        notify.showWarningNotification("bottom", "right", message);
      },
    });
  });

  // calculate amount
  $("#calculate-amount").on("click", function () {
    var quantity = parseFloat($(".quantity").val());
    var rate = parseFloat($(".rate").val());
    var totalAmount = quantity * rate;

    // Convert the totalAmount to a string to retain precision
    var totalAmountStr = totalAmount.toString();

    // Set the value of the amount field to the totalAmount
    $(".amount").val(totalAmountStr);
  });

  // $("#calculate-cgst").on("click", function () {
  //   var gst = parseFloat($(".material-unit").val());
  //   var amount = parseFloat($(".amount").val());
  //   var cgst = (amount * gst) / 100;

  //   $(".cgst").val(cgst.toString());
  // });

  // View Details
  $(".view-details").on("click", function () {
    var productName = $(this).data("product-name");
    var orderType = $(this).data("order-type");
    var orderInOut = $(this).data("order-in-out");
    var orderDate = $(this).data("order-date");

    $("#order .modal-body").html(`
                <p class='mb-2'><strong>Company Name:</strong> ${productName}</p>
                <p class='mb-2'><strong>company address:</strong> ${orderType}</p>
                <p class='mb-2'><strong>gstin:</strong> ${orderInOut}</p>
                <p class='mb-2'><strong>invoice no:</strong> ${orderDate}</p>
            `);
  });
  $(".view-details-transfer").on("click", function () {
    var productName = $(this).data("company-name");
    var orderType = $(this).data("company-address");
    var orderInOut = $(this).data("party-name");
    var orderDate = $(this).data("party-address");
    var gstin = $(this).data("gstin");

    $("#transfer .modal-body").html(`
                <p class='mb-2'><strong>Company Name:</strong> ${productName}</p>
                <p class='mb-2'><strong>company Address:</strong> ${orderType}</p>
                <p class='mb-2'><strong>Party Name:</strong> ${orderInOut}</p>
                <p class='mb-2'><strong>Party Address:</strong> ${orderDate}</p>
                <p class='mb-2'><strong>GSTIN:</strong> ${gstin}</p>
            `);
  });
});
