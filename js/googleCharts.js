// Load the Visualization API and the piechart package.
  google.load('visualization', '1.0', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  //google.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawCharts(questionText, results) {

	// Create the data table.
	var data = new google.visualization.DataTable();

	data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');

	data.addRows(results);

	// Set chart options
	var options = {'title': questionText,
				   'width':800,
				   'height':800,
				   'backgroundColor': 'transparent'};

	var chart = new google.visualization.PieChart(document.getElementById("chart_div"));
	chart.draw(data, options);
  }
  
