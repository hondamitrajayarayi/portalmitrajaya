function getChartColorsArray(e) {
  if (null !== document.getElementById(e)) {
    var e = document.getElementById(e).getAttribute("data-colors");
    return (e = JSON.parse(e)).map(function(e) {
      var t = e.replace(" ", "");
      if (-1 === t.indexOf(",")) {
        var r = getComputedStyle(document.documentElement).getPropertyValue(t);
        return r || t
      }
      e = e.split(",");
      return 2 != e.length ? t : "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(e[0]) + "," + e[1] + ")"
    })
  }
}
function loadHSMChart(){

		  options = {
		    series: [{
		      name: "Interaction",
		      type: "area",
		      data: [34, 65, 46, 68, 49, 61, 42, 44, 78, 52, 63, 67]
		    }, {
		      name: "Outgoing",
		      type: "area",
		      data: [89.25, 98.58, 68.74, 108.87, 77.54, 84.03, 51.24, 28.57, 92.57, 42.36, 88.51, 36.57]
		    }, {
		      name: "Incoming",
		      type: "area",
		      data: [8, 12, 7, 17, 21, 11, 5, 9, 7, 29, 12, 35]
		    }],
		    chart: {
		      height: 374,
		      type: "line",
		      toolbar: {
		        show: !1
		      }
		    },
		    stroke: {
		      curve: "smooth",
		      dashArray: [3, 3, 3],
		      width: [1, 1, 1]
		    },
		    fill: {
		      opacity: [.1, .1, .1]
		    },
		    markers: {
		      size: [4, 4, 4],
		      strokeWidth: 2,
		      hover: {
		        size: 4
		      }
		    },
		    xaxis: {
		      categories: ["1 Mar","2 Mar","3 Mar","4 Mar","5 Mar","6 Mar","7 Mar","8 Mar","9 Mar","10 Mar","11 Mar","12 Mar"],
		      axisTicks: {
		        show: !1
		      },
		      axisBorder: {
		        show: !1
		      }
		    },
		    grid: {
		      show: !0,
		      xaxis: {
		        lines: {
		          show: !0
		        }
		      },
		      yaxis: {
		        lines: {
		          show: !1
		        }
		      },
		      padding: {
		        top: 0,
		        right: -2,
		        bottom: 15,
		        left: 10
		      }
		    },
		    legend: {
		      show: !0,
		      horizontalAlign: "center",
		      offsetX: 0,
		      offsetY: -5,
		      markers: {
		        width: 9,
		        height: 9,
		        radius: 6
		      },
		      itemMargin: {
		        horizontal: 10,
		        vertical: 0
		      }
		    },
		    plotOptions: {
		      bar: {
		        columnWidth: "30%",
		        barHeight: "70%"
		      }
		    },
		    colors: ['#0ab39c','#299cdb','#f7b84b'],
		    tooltip: {
		      shared: !0,
		      y: [{
		        formatter: function(e) {
		          return e
		        }
		      }, {
		        formatter: function(e) {
		          return e
		        }
		      }, {
		        formatter: function(e) {
		          return e
		        }
		      }]
		    }
		  },
		  chart = new ApexCharts(document.querySelector("#hsm-chart"), options);
		chart.render();
}
function loadConversationChart(){

		  options = {
		    series: [{
		      name: "Interaction",
		      type: "area",
		      data: [34, 65, 46, 68, 49, 61, 42, 44, 78, 52, 63, 67]
		    }, {
		      name: "Outgoing",
		      type: "area",
		      data: [89.25, 98.58, 68.74, 108.87, 77.54, 84.03, 51.24, 28.57, 92.57, 42.36, 88.51, 36.57]
		    }, {
		      name: "Incoming",
		      type: "area",
		      data: [8, 12, 7, 17, 21, 11, 5, 9, 7, 29, 12, 35]
		    }],
		    chart: {
		      height: 374,
		      type: "line",
		      toolbar: {
		        show: !1
		      }
		    },
		    stroke: {
		      curve: "smooth",
		      dashArray: [3, 3, 3],
		      width: [1, 1, 1]
		    },
		    fill: {
		      opacity: [.1, .1, .1]
		    },
		    markers: {
		      size: [4, 4, 4],
		      strokeWidth: 2,
		      hover: {
		        size: 4
		      }
		    },
		    xaxis: {
		      categories: ["1 Mar","2 Mar","3 Mar","4 Mar","5 Mar","6 Mar","7 Mar","8 Mar","9 Mar","10 Mar","11 Mar","12 Mar"],
		      axisTicks: {
		        show: !1
		      },
		      axisBorder: {
		        show: !1
		      }
		    },
		    grid: {
		      show: !0,
		      xaxis: {
		        lines: {
		          show: !0
		        }
		      },
		      yaxis: {
		        lines: {
		          show: !1
		        }
		      },
		      padding: {
		        top: 0,
		        right: -2,
		        bottom: 15,
		        left: 10
		      }
		    },
		    legend: {
		      show: !0,
		      horizontalAlign: "center",
		      offsetX: 0,
		      offsetY: -5,
		      markers: {
		        width: 9,
		        height: 9,
		        radius: 6
		      },
		      itemMargin: {
		        horizontal: 10,
		        vertical: 0
		      }
		    },
		    plotOptions: {
		      bar: {
		        columnWidth: "30%",
		        barHeight: "70%"
		      }
		    },
		    colors: ['#0ab39c','#299cdb','#f7b84b'],
		    tooltip: {
		      shared: !0,
		      y: [{
		        formatter: function(e) {
		          return e
		        }
		      }, {
		        formatter: function(e) {
		          return e
		        }
		      }, {
		        formatter: function(e) {
		          return e
		        }
		      }]
		    }
		  },
		  chart = new ApexCharts(document.querySelector("#interactions-summary-chart"), options);
		chart.render();
}

  options = {
    series: [50000,26000,66000,30000],
    labels: ["Whatsapp", "Line","Webchat", "Mobile"],
    chart: {
      type: "donut",
      height: 219
    },
    plotOptions: {
      pie: {
        size: 100,
        donut: {
          size: "76%"
        }
      }
    },
    dataLabels: {
      enabled: !1
    },
    legend: {
      show: !1,
      position: "bottom",
      horizontalAlign: "center",
      offsetX: 0,
      offsetY: 0,
      markers: {
        width: 20,
        height: 6,
        radius: 2
      },
      itemMargin: {
        horizontal: 12,
        vertical: 0
      }
    },
    stroke: {
      width: 0
    },
    yaxis: {
      labels: {
        formatter: function(e) {
          return e + " Unique Users"
        }
      },
      tickAmount: 4,
      min: 0
    },
    colors: ['#405189','#f7b84b','#0ab39c','#299cdb']
  };
(chart = new ApexCharts(document.querySelector("#user_device_pie_charts"), options)).render();
  options = {
    series: [{
      name: "Whatsapp",
      data: [50000],
      color: '#405189'
    }, {
      name: "Line",
      data: [20000],
      color: "#f7b84b"
    }, {
      name: "Webchat",
      data: [65000],
      color:"#0ab39c"
    }
, {
      name: "Mobile",
      data: [29000],
      color:"#299cdb"
    }
    ],
    chart: {
      type: "bar",
      height: 341,
      toolbar: {
        show: !1
      }
    },
    plotOptions: {
      bar: {
        horizontal: !1,
        columnWidth: "65%"
      }
    },
    stroke: {
      show: !0,
      width: 5,
      colors: ["transparent"]
    },
    xaxis: {
      categories: [""],
      axisTicks: {
        show: !1,
        borderType: "solid",
        color: "#78909C",
        height: 6,
        offsetX: 0,
        offsetY: 0
      },
      title: {
        text: "Channel",
        offsetX: 0,
        offsetY: -30,
        style: {
          color: "#78909C",
          fontSize: "12px",
          fontWeight: 400
        }
      }
    },
    yaxis: {
      labels: {
        formatter: function(e) {
          //return "$" + e + "k"
          return e
        }
      },
      tickAmount: 4,
      min: 0
    },
    fill: {
      opacity: 1
    },
    legend: {
      show: !0,
      position: "bottom",
      horizontalAlign: "center",
      fontWeight: 500,
      offsetX: 0,
      offsetY: -14,
      itemMargin: {
        horizontal: 8,
        vertical: 0
      },
      markers: {
        width: 10,
        height: 10
      }
    },
   // colors: areachartColors
  },
  chart = new ApexCharts(document.querySelector("#interaction-channel-chart"), options);
chart.render();

var revenueExpensesChartsColors = getChartColorsArray("revenue-expenses-charts"),
  options = {
    series: [{
      name: "New User",
      data: [20, 25, 30, 35, 40, 55, 70, 110, 150, 180, 210, 250]
    }, {
      name: "Returning User",
      data: [12, 17, 45, 42, 24, 35, 42, 75, 102, 108, 156, 199]
    }],
    chart: {
      height: 290,
      type: "area",
      toolbar: "false"
    },
    dataLabels: {
      enabled: !1
    },
    stroke: {
      curve: "smooth",
      width: 2
    },
    xaxis: {
      categories: ["1 Mar","2 Mar","3 Mar","4 Mar","5 Mar","6 Mar","7 Mar","8 Mar","9 Mar","10 Mar","11 Mar","12 Mar"]
    },
    yaxis: {
      labels: {
        formatter: function(e) {
          return  e + "k"
        }
      },
      tickAmount: 5,
      min: 0,
      max: 260
    },
    colors: revenueExpensesChartsColors,
    fill: {
      opacity: .06,
      colors: revenueExpensesChartsColors,
      type: "solid"
    }
  };
(chart = new ApexCharts(document.querySelector("#revenue-expenses-charts"), options)).render();

function loadTicketChart(){
var revenueExpensesChartsColors = getChartColorsArray("ticket-charts"),
    options = {
      series: [{
        name: "New Ticket",
        data: [20, 25, 30, 35, 40, 55, 70, 110, 150, 180, 210, 250,20, 25, 30, 35, 40, 55, 70, 110, 150]
      }, {
        name: "Resolved Ticket",
        data: [12, 17, 45, 42, 24, 35, 42, 75, 102, 108, 156, 199,12, 17, 45, 42, 24, 35, 42, 75, 102]
      }],
      chart: {
        height: 290,
        width: '100%',
        type: "area",
        toolbar: "false"
      },
      dataLabels: {
        enabled: !1
      },
      stroke: {
        curve: "smooth",
        width: 2
      },
      xaxis: {
        categories: ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21"]
      },
      yaxis: {
        labels: {
          formatter: function(e) {
            return  e + "k"
          }
        },
        tickAmount: 5,
        min: 0,
        max: 260
      },
      colors: revenueExpensesChartsColors,
      fill: {
        opacity: .06,
        colors: revenueExpensesChartsColors,
        type: "solid"
      }
    };
  (chart = new ApexCharts(document.querySelector("#ticket-charts"), options)).render();


    options = {
      series: [{
        name: "Critical",
        data: [50000],
        color: '#c90303'
      }, {
        name: "High",
        data: [20000],
        color: "#ffb148"
      }, {
        name: "Medium",
        data: [65000],
        color:"#0ab39c"
      }
  , {
        name: "Low",
        data: [29000],
        color:"#299cdb"
      }
      ],
      chart: {
        type: "bar",
        height: 341,
        toolbar: {
          show: !1
        }
      },
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "65%"
        }
      },
      stroke: {
        show: !0,
        width: 5,
        colors: ["transparent"]
      },
      xaxis: {
        categories: [""],
        axisTicks: {
          show: !1,
          borderType: "solid",
          color: "#78909C",
          height: 6,
          offsetX: 0,
          offsetY: 0
        },
        title: {
          text: "Channel",
          offsetX: 0,
          offsetY: -30,
          style: {
            color: "#78909C",
            fontSize: "12px",
            fontWeight: 400
          }
        }
      },
      yaxis: {
        labels: {
          formatter: function(e) {
            //return "$" + e + "k"
            return e
          }
        },
        tickAmount: 4,
        min: 0
      },
      fill: {
        opacity: 1
      },
      legend: {
        show: !0,
        position: "bottom",
        horizontalAlign: "center",
        fontWeight: 500,
        offsetX: 0,
        offsetY: -14,
        itemMargin: {
          horizontal: 8,
          vertical: 0
        },
        markers: {
          width: 10,
          height: 10
        }
      },
     // colors: areachartColors
    },
    chart = new ApexCharts(document.querySelector("#ticket-priority-chart"), options);
  chart.render();




    options = {
      series: [{
        name: "Problem",
        data: [33245],
        color: '#94ccfb'
      }, {
        name: "Feature Request",
        data: [10323],
        color: "#a64489"
      }, {
        name: "Inquiry",
        data: [43444],
        color:"#0ab39c"
      }
  , {
        name: "Others",
        data: [22221],
        color:"#299cdb"
      }
      ],
      chart: {
        type: "bar",
        height: 341,
        toolbar: {
          show: !1
        }
      },
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "65%"
        }
      },
      stroke: {
        show: !0,
        width: 5,
        colors: ["transparent"]
      },
      xaxis: {
        categories: [""],
        axisTicks: {
          show: !1,
          borderType: "solid",
          color: "#78909C",
          height: 6,
          offsetX: 0,
          offsetY: 0
        },
        title: {
          text: "Channel",
          offsetX: 0,
          offsetY: -30,
          style: {
            color: "#78909C",
            fontSize: "12px",
            fontWeight: 400
          }
        }
      },
      yaxis: {
        labels: {
          formatter: function(e) {
            //return "$" + e + "k"
            return e
          }
        },
        tickAmount: 4,
        min: 0
      },
      fill: {
        opacity: 1
      },
      legend: {
        show: !0,
        position: "bottom",
        horizontalAlign: "center",
        fontWeight: 500,
        offsetX: 0,
        offsetY: -14,
        itemMargin: {
          horizontal: 8,
          vertical: 0
        },
        markers: {
          width: 10,
          height: 10
        }
      },
     // colors: areachartColors
    },
    chart = new ApexCharts(document.querySelector("#ticket-type-chart"), options);
  chart.render();
}


