(function ( $ ) {

	$.fn.datagrid = function(options) {

		var table = $(this);
		var data = [];
		var searchInputElementOriginal = {};
		var delay = (function() {
            var timer = 0;
            return function(callback, ms){
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();
		var config 	= $.extend({
			url 				: '',
			primaryField		: '',
			sortBy				: '',
			orderBy				: 'DESC',
	        pagingElement 		: '',
	        optionPagingElement : '',
	        searchFieldElement	: '',
	        searchInputElement	: '',
	        pageInfoElement		: '',
	        delayTime			: 800,
	        rowNumber			: false, 
	        rowCheck			: false,
	        columns 			: [],
	        mergeCells			: [],
	       	activePageNumber	: 1,
	        itemsPerPage		: 5,
	        itemsPerPageOption 	: [5, 10, 15, 20],
	        rowChecked 			: [],
	        queryParams 		: {},
	        rowDetail			: {}
	    }, options);

		// Create the table parts
		function BuildTableSection() {
			var tableString = "<thead></thead><tbody></tbody>";
			$(table).append(tableString);
		}

		// Merged cells
		function PrintMergeCells() {

			// Create a wrapper element for the merged cells
			var theadMergeCellsString = "<tr id='thead-merge-cells'></tr>";
			$(table).find('thead').append(theadMergeCellsString);

			// Show column number if it is enabled
			if (config.rowNumber == true) {
				var rowNumberString = "<th sortable='false' style='text-align: center; width: 20px;' rowspan='2'>No</th>";
				$(table).find('#thead-merge-cells').append(rowNumberString);
			}

			// Show column checkbox if it is enabled
			if (config.rowCheck == true) {
				var rowCheckString = "<th sortable='false' style='text-align: center; width: 20px;' rowspan='2'><input type='checkbox'></th>";
				$(table).find('#thead-merge-cells').append(rowCheckString);
				CheckAllRow();
			}

			if (!$.isEmptyObject(config.rowDetail)) {
				var rowDetail = "<th sortable='false' style='text-align: center; width: 20px;' rowspan='2'></th>";
				$(table).find('#thead-merge-cells').append(rowDetail);
			}

			// Check each merged cells by comparing an columns array and mergecells array
			config.columns.forEach(function(row_column, i) {

				var print_merge_thead = false;
				var align 		= '';
				var colspan 	= '';
				var title 		= '';

				// Check for each merged cells
				// If it is merged cells save property columns and show
				config.mergeCells.forEach(function(row_cell) {
					if (i == row_cell.index) {
						print_merge_thead = true;
						align 		= row_cell.align;
						colspan 	= row_cell.colspan;
						title 		= row_cell.title;
					}
				});

				// Check if the position of these cells exist between the merged cells
				// If yes then do not need to display anything
				if (!print_merge_thead) {
					config.mergeCells.forEach(function(row_cell) {
						if (i > row_cell.index && i < row_cell.index + row_cell.colspan) {
							print_merge_thead = null;
						}
					});
				}

				// Show the elements according to the conditions above
				var columnString = '';
				if (print_merge_thead) {
					columnString = "<th sortable='false' style='text-align: " + align + ";' colspan='" + colspan + "'>" + title + "</th>";
				} else if (print_merge_thead == false) {
					row_column.sortable 	= row_column.sortable == undefined ? true : row_column.sortable;
					row_column.width 		= row_column.width == undefined ? 150 : row_column.width;
					row_column.align 		= row_column.align == undefined ? 'center' : row_column.align;
					columnString = "<th title='" + row_column.field + "' sortable='" + row_column.sortable + "' style='text-align: " + row_column.align + "; width: " + row_column.width + "px;' rowspan='2'>" + row_column.title + "</th>"; 
				}

				$(table).find('#thead-merge-cells').append(columnString);
			});
		}

		// Regular cells
		function PrintNormalCells() {
			
			// Create a wrapper element for the regular cells
			var theadTitleString = "<tr id='thead-title'></tr>";
			$(table).find('thead').append(theadTitleString);

			// Show column number if it is enabled and mergecells array not defined
			if (config.rowNumber == true && config.mergeCells.length == 0) {
				var rowNumberString = "<th sortable='false' style='text-align: center; width: 20px;'>No</th>";
				$(table).find('#thead-title').append(rowNumberString);
			}
			
			// Show column checkbox if it is enabled and mergecells array not defined
			if (config.rowCheck == true && config.mergeCells.length == 0) {
				var rowCheckString = "<th sortable='false' style='text-align: center; width: 20px;'><input type='checkbox'></th>";
				$(table).find('#thead-title').append(rowCheckString);
				CheckAllRow();
			}

			if (!$.isEmptyObject(config.rowDetail) && config.mergeCells.length == 0) {
				var rowDetail = "<th sortable='false' style='text-align: center; width: 20px;'></th>";
				$(table).find('#thead-title').append(rowDetail);
			}
			
			// Show each column
			config.columns.forEach(function(row, i) {

				// Check if the position of these cells exist between the merged cells
				// If yes then show the cells but otherwise it does not need to display anything
				var print_normal_thead = false;
				if (config.mergeCells.length > 0) {
					config.mergeCells.forEach(function(row_cell) {
						if (i >= row_cell.index && i < row_cell.index + row_cell.colspan) {
							print_normal_thead = true;
						}
					});
				} else {
					print_normal_thead = true;
				}

				// Show the elements according to the conditions above
				var columnString;
				if (print_normal_thead) {
					row.sortable 	= row.sortable == undefined ? true : row.sortable;
					row.width 		= row.width == undefined ? 150 : row.width;
					row.align 		= row.align == undefined ? 'center' : row.align;
					columnString = "<th title='" + row.field + "' sortable='" + row.sortable + "' style='text-align: " + row.align + "; width: " + row.width + "px;'>" + row.title + "</th>";
				}

				$(table).find('#thead-title').append(columnString);
			});
		}

		// Post data
		function AjaxRequest(activePageNumber, itemsPerPage, dataSearch, complete) {
			var postData = $.extend({
				limit 		: parseInt(activePageNumber) * itemsPerPage - itemsPerPage,
				offset 		: itemsPerPage, 
				sort 		: config.sortBy, 
				order 		: config.orderBy,
				dataSearch  : dataSearch
			}, config.queryParams);

			// Post data
			$.ajax({
				url 		: config.url,
				type 		: 'post',
				dataType 	: 'json',
				data 		: postData,
				success: function(responseJsonData) {
					data = responseJsonData;
					complete();
				}
			});
		}

		function datagridMessage(message) {
			var rowCount = config.columns.length + (GetUsedRow() + 1);
			var loading_temp = "<tr><td colspan='" + rowCount + "' style='text-align: center;'>" + message + "</td></tr>";
			$(table).find('tbody').html(loading_temp);
		}

		// Display data
		function DisplayData(activePageNumber, itemsPerPage, dataSearch) {

			// Loading status
			datagridMessage('Loading data...');

			// Ajax post
			AjaxRequest(activePageNumber, itemsPerPage, dataSearch, function() {
				var pageNumber 	= (parseInt(activePageNumber) * itemsPerPage - itemsPerPage) + 1;
				var temp 		= "";
				var rowData 	= "";
				var rowIndex 	= "";

				// Check active page number
				if (parseInt(activePageNumber) > Math.ceil(data.total / itemsPerPage) && Math.ceil(data.total / itemsPerPage) > 0) {
					config.activePageNumber = 1;
					DisplayData(config.activePageNumber, config.itemsPerPage, SearchInput());
				}

				if (data.total >= 1) {
					for (var i = 0; i < data.rows.length; i++) {
						temp += "<tr class='main-row'>";

						// Show column number if it is enabled
						if (config.rowNumber) {
							temp += "<td style='text-align: center;'>" + pageNumber + "</td>";
						}

						// Show column checkbox if it is enabled
						if (config.rowCheck) {
							temp += "<td class='checkbox-column' style='text-align: center;'><input value='" + data.rows[i][config.primaryField] + "' type='checkbox'></td>";
						}

						if (!$.isEmptyObject(config.rowDetail)) {
							temp += "<td style='text-align: center;'>" +
										"<div class='detail-link' data-id='" + i + "' data-expand='false' style='width: 10px; height: 4px; margin-left: auto; margin-right: auto; cursor: pointer; margin-top: 8px; background-color: #595959; border: 1px solid #595959; -border-radius: 0.1em; -moz-border-radius: 0.1em; -webkit-border-radius: 0.1em;'>" + 
											"<div style='width: 4px; height: 10px; cursor: pointer; margin-top: -4px; margin-left: 2px; background-color: #595959; border: 1px solid #595959; -border-radius: 0.1em; -moz-border-radius: 0.1em; -webkit-border-radius: 0.1em;'></div>" +
										"</div>" +
									"</td>";
						}

						// check if the column is worth undefined then call the anonymous function
						config.columns.forEach(function(rowColumn) {
							if (typeof data.rows[i][rowColumn.field] !== 'undefined') {
								temp += "<td style='text-align: " + rowColumn.align + "; width: " + rowColumn.width + "px;'>" + data.rows[i][rowColumn.field] + "</td>";
							} else if (typeof rowColumn.rowStyler !== 'undefined') {
								rowData = data.rows[i];
								rowIndex = i;
								temp += "<td style='text-align: " + rowColumn.align + "; width: " + rowColumn.width + "px;'>" + rowColumn.rowStyler(data.rows[i], i) + "</td>";
							} else {
								temp += "<td style='text-align: " + rowColumn.align + "; width: " + rowColumn.width + "px;'>Undefined</td>";	
							}
						});

						temp += "</tr>";

						pageNumber++;
					}

					$(table).find('tbody').html(temp);
				} else {
					// Loading status
					datagridMessage('No records found...');
				}

				// Paging data
				PagingData(activePageNumber, itemsPerPage);

				// Check uncheck row
				CheckRow();

				// Page info
				PageInfo(activePageNumber, itemsPerPage);

				// Detail row
				ShowDetailRow();
			});
		}

		// Display paging
		function PagingData(activePageNumber, itemsPerPage) {

			var total_page = Math.ceil(data.total / itemsPerPage)

			// Reset pagination
			$(config.pagingElement).html('')

			// First
    		var first_template = $('<li><a href="javascript:void(0);">First</a></li>')
    		if (activePageNumber > 1) {
    			$(first_template).on('click', function() { 
    				DisplayData(1, itemsPerPage, SearchInput())
    			})
    		}
    		$(config.pagingElement).append(first_template)

    		// Prev
    		var prev_template = $('<li><a href="javascript:void(0);">Prev</a></li>')
    		if (activePageNumber > 1) {
    			$(prev_template).on('click', function() {
    				DisplayData(activePageNumber - 1, itemsPerPage, SearchInput())
    			})
    		}
    		$(config.pagingElement).append(prev_template)

    		// Page before
    		var start
    		if (activePageNumber - 3 <= 0) {
    			start = 1
	    		} else {
	    			var append = 0
	    			if (activePageNumber + 3 > total_page) {
	    				var margin = (activePageNumber + 3) - total_page
	    				if (activePageNumber - 3 - margin > 0) {
	    					append = margin
	    				} else {
	    					append = (activePageNumber - 1) - 3
	    				}
	    			} else {
	    				append = 0
	    			}

	    			start = activePageNumber - 3 - append
	    		}

			for (var i = start; i < activePageNumber; i++) {
				var page_template = $('<li data-page="' + i + '"><a href="javascript:void(0);">' + i + '</a></li>')
				$(page_template).on('click', function() {
					DisplayData(parseInt($(this).attr('data-page')), itemsPerPage, SearchInput())
				})
				$(config.pagingElement).append(page_template)
			}

			// Current page
			$(config.pagingElement).append('<li class="active"><a href="javascript:void(0);">' + activePageNumber + '</a></li>')

			// Page after
    		var end
    		if (activePageNumber + 3 > total_page) {
    			end = total_page
    		} else {
    			var append = 0
    			if (activePageNumber - 3 <= 0) {
    				var margin = 3 - (activePageNumber - 1)
    				if (activePageNumber + 3 + margin > total_page) {
    					append = total_page - activePageNumber - 3
    				} else {
    					append = margin
    				}
    			} else {
    				append = 0
    			}

    			end = activePageNumber + 3 + append
    		}

			for (var i = activePageNumber + 1; i <= end; i++) {
				var page_template = $('<li data-page="' + i + '"><a href="javascript:void(0);">' + i + '</a></li>')
				$(page_template).on('click', function() {
					DisplayData(parseInt($(this).attr('data-page')), itemsPerPage, SearchInput())
				})
				$(config.pagingElement).append(page_template)
			}

    		// Next
    		var next_template = $('<li><a href="javascript:void(0);">Next</a></li>')
    		if (activePageNumber < total_page) {
    			$(next_template).on('click', function() {
    				DisplayData(activePageNumber + 1, itemsPerPage, SearchInput())
    			})
    		}
    		$(config.pagingElement).append(next_template)

    		// Last
    		var last_template = $('<li><a href="javascript:void(0);">Last</a></li>')
    		if (activePageNumber < total_page) {
    			$(last_template).on('click', function() {
    				DisplayData(total_page, itemsPerPage, SearchInput())
    			})
    		}
    		$(config.pagingElement).append(last_template)
		}

		// Option paging
		function OptionPaging() {
			// Option item perpage
			var tempOption = "";
			for (var i = 0; i < config.itemsPerPageOption.length; i++) {
				tempOption += "<option value='" + config.itemsPerPageOption[i] + "'>" + config.itemsPerPageOption[i] + "</option>";
			}

			$(config.optionPagingElement).html(tempOption);
			$(config.optionPagingElement).val(config.itemsPerPage);

			$(config.optionPagingElement).on('change', function() {
				config.itemsPerPage = $(config.optionPagingElement).children('option:selected').val();
				DisplayData(1, config.itemsPerPage, SearchInput());
			});
		}

		// Check used row
		function GetUsedRow() {
			var temp = -1;
			config.rowNumber == true ? temp += 1 : '';
			config.rowCheck == true ? temp += 1 : '';
			!$.isEmptyObject(config.rowDetail) ? temp += 1 : '';
			return temp;
		}

		// Chek uncheck row
		function CheckRow() {
			$(table).find('.checkbox-column').each(function() {
				$(this).children().each(function(index, object) {		
				
					// Check Checkbox sesuai array
					for (var i = 0; i < config.rowChecked.length; i++) {
						if (config.rowChecked[i] == $(this).attr('value')) {
							$(this).prop("checked", true);
						}
					}

					$(this).on('click', function() {
						var temp, found = false;
						for (var i = 0; i < config.rowChecked.length; i++) {
							if (config.rowChecked[i] == this.value) {
								found = true;
								temp = i;
							}
						}

						if (!found) {
							config.rowChecked[config.rowChecked.length] = parseInt(this.value);
						} else {
							config.rowChecked.splice(temp, 1);
						}
						
						CheckTheadCheckbox();
					});
				});
			});

			CheckTheadCheckbox();
		}

		function CheckTheadCheckbox() {
			// Uncheck thead checkbox
			var selector 	= $(table).children('thead').find('input[type="checkbox"]');
			var arr 		= GetAllCheckbox();
			var boolCheck	= true;	

			for (var z = 0; z < arr.length; z++) {
				if (!$(arr[z]).prop("checked")) {
					boolCheck = false;
				}
			}

			if (boolCheck) {
				selector.prop('checked', true);
			} else {
				selector.prop('checked', false);
			}
		}

		function GetAllCheckbox() {
			var arr = [];
			$(table).find('.checkbox-column').each(function() {
				$(this).children().each(function(index, object) {
					arr[arr.length] = $(this);
				});
			});

			return arr;
		}

		function CheckAllRow() {
			var selector = $(table).children('thead').find('input[type="checkbox"]');
			$(selector).on('click', function() {

				var arr = GetAllCheckbox();
				
				if ($(this).prop('checked')) {				
					for (var z = 0; z < arr.length; z++) {
						$(arr[z]).prop('checked', true);
	
						var temp, found = false;
						for (var i = 0; i < config.rowChecked.length; i++) {
							if (config.rowChecked[i] == $(arr[z]).attr('value')) {
								found = true;
								temp = i;
							}
						}

						if (!found) {
							config.rowChecked[config.rowChecked.length] = parseInt($(arr[z]).attr('value'));
						}
					}
				} else {			
					for (var z = 0; z < arr.length; z++) {
						$(arr[z]).prop('checked', false);

						var temp, found = false;
						for (var i = 0; i < config.rowChecked.length; i++) {
							if (config.rowChecked[i] == $(arr[z]).attr('value')) {
								found = true;
								temp = i;
							}
						}

						if (found) {
							config.rowChecked.splice(temp, 1);
						}
					}
				}
			});
		}

		// Search data
	    function Search() {
	    	// Save original search input element
	    	searchInputElementOriginal = {
	    		selector 	: config.searchInputElement,
	    		element 	: $(config.searchInputElement).clone()	
	    	};

			config.columns.forEach(function(rowColumn, key) {
				rowColumn.search = rowColumn.search == undefined ? true : rowColumn.search;
				if (rowColumn.search) {
					// Check for custom search
					if (rowColumn.custom_search == undefined) {
						$(config.searchFieldElement).append('<option value="' + rowColumn.field + '">' + rowColumn.title + '</option>');
					} else {
						$(config.searchFieldElement).append('<option data-option="' + key + '" value="' + rowColumn.field+ '">' + rowColumn.title + '</option>');
					}
				}
			});

			CustomSearch(config.searchFieldElement);
	    	$(config.searchFieldElement).on('change', function() {
	    		CustomSearch($(this));
	    	});
	    }

	    // Generate Custom search
	    function CustomSearch(el) {
	    	var costum_search = $(el).find('option:selected').attr('data-option');
    		if (costum_search == undefined) {
    			$(config.searchInputElement).replaceWith(searchInputElementOriginal.element);
		    	$(config.searchInputElement).on('keyup', function() {
		    		delay(function() {
		    			DisplayData(1, config.itemsPerPage, SearchInput());
					}, config.delayTime );
		    	});
    		} else {
    			var select = $('<select></select>');
    			var column = $(el).find('option:selected').attr('value');
    			config.columns.forEach(function(rowColumn, key) {
					if (rowColumn.field == column) {
						if (searchInputElementOriginal.selector.indexOf('.') == -1) {
							var selector = searchInputElementOriginal.selector.replace('#', '');
							$(select).attr('id', selector);
							$(select).attr('class', rowColumn.custom_search.appendClass);
						} else {
							var selector = searchInputElementOriginal.selector.replace('.', '');
							$(select).attr('class', rowColumn.custom_search.appendClass + ' ' + selector);
						}
						
						rowColumn.custom_search.option.forEach(function(rowColumn_, key_) {
							$(select).append('<option value="' + rowColumn_.value + '">' + rowColumn_.text + '</option>');
						});
					}
				});
				$(select).on('change', function() {
		    		DisplayData(1, config.itemsPerPage, SearchInput());
		    	});
				$(config.searchInputElement).replaceWith(select);
    		}

			DisplayData(1, config.itemsPerPage, SearchInput());
	    }

	    // Search data
	    function SearchInput() {
	    	var field 		= $(config.searchFieldElement).val();
    		var value 		= $(config.searchInputElement).val();
    		var temp 		= { field : field, value : value };

			if (field == undefined || value == undefined) {
				return '';
			} else {
				return temp;
			}
	    }

	    // Page info
	    function PageInfo(activePageNumber, itemsPerPage) {

	    	if (data.total >= 1) {
				var limit, offset;
				
				limit 		= ((activePageNumber * itemsPerPage) - itemsPerPage) + 1;
				if (activePageNumber == Math.ceil(data.total / itemsPerPage)) {
					offset = (activePageNumber * itemsPerPage) - ((activePageNumber * itemsPerPage) - data.total);
				} else {
					offset = (activePageNumber * itemsPerPage);
				}
				
				$(config.pageInfoElement).html('Showing ' + limit + ' - ' + offset + ' of ' + data.total + ' entries');
	    	} else {
	    		$(config.pageInfoElement).html('Showing ' + 0 + ' - ' + 0 + ' of ' + 0 + ' entries');
	    	}
	    }

	    function SortArrow() {
	    	$(table).children('thead').children().children().each(function(index, object) {
				if ($(object).attr('sortable') != 'false') {
			    	var arrow_up 	= $('<span></span>');
					$(arrow_up).css({
						'width' 		: '0px',
						'height' 		: '0px',
						'border'	 	: '4px solid transparent',
						'border-bottom'	: '5px solid #ccc',
						'position'		: 'absolute',
						'margin-left'	: '5px',
						'margin-top'	: '0px'
					});
					$(this).append(arrow_up);

					var arrow_down 	= $('<span></span>');
					$(arrow_down).css({
						'width' 		: '0px',
						'height' 		: '0px',
						'border'	 	: '4px solid transparent',
						'border-top' 	: '5px solid #ccc',
						'position'		: 'absolute',
						'margin-left'	: '5px',
						'margin-top'	: '11px'
					});
					$(this).append(arrow_down);
				}
			});
	    }

	    // Sort data
	    function SortData() {
	    	// Set sort data by primary field
	    	config.sortBy = config.primaryField;
	    	SortArrow();

			$(table).children('thead').children().children().each(function(index, object) {
				if ($(object).attr('sortable') != 'false') {
					$(this).css('cursor', 'pointer');					
					$(this).on('click', function() {	
						$(table).children('thead').children().children().each(function(index, object) {
							$(this).children('span').remove();
						});

						SortArrow();
						var arrow = $('<span></span>');
						$(this).append(arrow);
						
						if ($(this).attr('data-sortby') == null || $(this).attr('data-sortby') == 'DESC') {
							$(this).attr('data-sortby', 'ASC');
							$(this).children('span').css({
								'width' 		: '0px',
								'height' 		: '0px',
								'border'	 	: '4px solid transparent',
								'border-bottom'	: '5px solid #333',
								'position'		: 'absolute',
								'margin-left'	: '5px',
								'margin-top'	: '3px'
							});
						} else {
							$(this).attr('data-sortby', 'DESC');
							$(this).children('span').css({
								'width' 		: '0px',
								'height' 		: '0px',
								'border'	 	: '4px solid transparent',
								'border-top' 	: '5px solid #333',
								'position'		: 'absolute',
								'margin-left'	: '5px',
								'margin-top'	: '7px'
							});
						}

						config.sortBy 	= this.title;
						config.orderBy 	= $(this).attr('data-sortby');

						DisplayData(config.activePageNumber, config.itemsPerPage, SearchInput());
					});	
				}
			});
	    }

	    function ShowDetailRow() {
	    	$(table).find('.detail-link').each(function() {
	    		$(this).off();
	    		$(this).on('click', function() {
	    			var rowIndex = $(this).attr('data-id');
	    			if ($(this).attr('data-expand') == 'false') {
						var formatter = "<tr id='detail-row-" + rowIndex + "' style='display: none;'>" +
											"<td colspan='" + (GetUsedRow() + 1) + "'></td>" +
											"<td colspan='" + config.columns.length + "' class='detail-content'>" +
												config.rowDetail.formatter(data.rows[rowIndex], rowIndex)											
											"</td>" +
										"</tr>";
						$(formatter).insertAfter($(this).closest("tr")).fadeIn();
						config.rowDetail.onExpandRow(data.rows[rowIndex], rowIndex);

						var temp = "<div class='detail-link' data-id='" + rowIndex + "' data-expand='true' style='width: 10px; height: 4px; margin-left: auto; margin-right: auto; cursor: pointer; margin-top: 8px; background-color: #595959; border: 1px solid #595959; -border-radius: 0.1em; -moz-border-radius: 0.1em; -webkit-border-radius: 0.1em;'></div>";
						$(this).closest("td").html(temp);
	    			} else {
	    				$(this).closest("tr").next().fadeOut(function() {
	    					$(this).remove();
	    				});

	    				var temp = "<div class='detail-link' data-id='" + rowIndex + "' data-expand='false' style='width: 10px; height: 4px; margin-left: auto; margin-right: auto; cursor: pointer; margin-top: 8px; background-color: #595959; border: 1px solid #595959; -border-radius: 0.1em; -moz-border-radius: 0.1em; -webkit-border-radius: 0.1em;'>" + 
										"<div style='width: 4px; height: 10px; cursor: pointer; margin-top: -4px; margin-left: 2px; background-color: #595959; border: 1px solid #595959; -border-radius: 0.1em; -moz-border-radius: 0.1em; -webkit-border-radius: 0.1em;'></div>" +
									"</div>";
						$(this).closest("td").html(temp);
	    			}

	    			ShowDetailRow();
	    		});
	    	});
	    }

	    this.reload = function() {
	    	DisplayData(config.activePageNumber, config.itemsPerPage, SearchInput());
	    }

		this.getChecked = function() {
			return config.rowChecked;
		}

		this.setChecked = function(arr) {
			for (var i = 0; i < arr.length; i++) {
				var temp = false;
				for (var z = 0; z < config.rowChecked.length; z++) {
					if (config.rowChecked[z] == arr[i]) {
						temp = true;
					}
				}

				if (!temp) {
					config.rowChecked[config.rowChecked.length] = arr[i];
				}
			}

			DisplayData(config.activePageNumber, config.itemsPerPage, SearchInput());
		}

		this.setUnchecked = function(arr) {
			for (var i = 0; i < arr.length; i++) {
				var index, temp = false;
				for (var z = 0; z < config.rowChecked.length; z++) {
					if (config.rowChecked[z] == arr[i]) {
						temp = true;
						index = z;
					}
				}

				if (temp) {
					config.rowChecked.splice(index, 1);
				}
			}

			DisplayData(config.activePageNumber, config.itemsPerPage, SearchInput());
		}
	
		this.getRowData = function(rowIndex) {
			return rowIndex == 'all' ? data.rows : data.rows[rowIndex];
		}

		function textMode(child, child_index, rowIndex, styler, onEdit, onSave) {
			if (child_index > GetUsedRow()) {
				var temp, field_name;
				config.columns.forEach(function(row_column, i) {
					if ((i + GetUsedRow() + 1) == child_index) {
						temp 		= row_column.editable;
						field_name 	= row_column.field;
					}
				});

				if (temp) {
					var temp 	= $(child).html();
					var object 	= styler(field_name, temp);
					
					// Check for last child element
					var lastElement;
					config.columns.forEach(function(row_column, i) {
						if (row_column.editable) {
							lastElement = i;
						}
					});

					if ($(child).attr('inline-edit') != 'active') {
						$(child).attr('inline-edit', 'active');
						$(child).html('<form>' + object + '</form>');

						if (lastElement + GetUsedRow() + 1 == child_index) {
							onEdit();
						}
					} else {
						$(child).attr('inline-edit', 'not-active');
						var element = $(child).children('form').serializeArray();
						$(child).html(element[0].value);
						data.rows[rowIndex][field_name] = element[0].value;
						
						if (lastElement + GetUsedRow() + 1 == child_index) {
							onSave();
						}
					}
				}
			}
		}

		function rowModifier(row, columnIndex, rowIndex, styler, onEdit, onSave) {
			$(row).children().each(function(child_index, child_object) {
				if (columnIndex == 'all') {
					textMode($(this), child_index, rowIndex, styler, onEdit, onSave);
				} else {
					if (child_index == (columnIndex + GetUsedRow() + 1)) {
						textMode($(this), child_index, rowIndex, styler, onEdit, onSave);
					}
				}
			});
		}

		this.editable = function(editableOptions) {

			var arrConfig 	= $.extend({
				rowIndex 	: 'all',
				columnIndex : 'all',
				styler 		: function(field_name, value) {
					return value;
				},
				onEdit 		: function() {
					console.log("Edited");
				},
				onSave 		: function() {
					console.log("Saved");
				}
		    }, editableOptions);

			$(table).children('tbody').children('.main-row').each(function(index, object) {
				if (arrConfig.rowIndex == 'all') {
					rowModifier($(this), arrConfig.columnIndex, index, arrConfig.styler, arrConfig.onEdit, arrConfig.onSave);
				} else {
					if (index == arrConfig.rowIndex) {
						rowModifier($(this), arrConfig.columnIndex, index, arrConfig.styler, arrConfig.onEdit, arrConfig.onSave);
					}
				}
			});
		}

		this.queryParams = function(params) {
			config.queryParams = $.extend(config.queryParams, params);
		}

		this.formLoad = function(form, rowIndex) {
			
			
			$(form).find('input[type=text]').each(function () {
				for (var key in data.rows[rowIndex]) {
					if(this.name == key) {
						$(this).val(data.rows[rowIndex][key]);
					}
				}
			});

			$(form).find('input[type=password]').each(function () {
				for (var key in data.rows[rowIndex]) {
					if(this.name == key) {
						$(this).val(data.rows[rowIndex][key]);
					}
				}
			});

			$(form).find('textarea').each(function () {
				for (var key in data.rows[rowIndex]) {
					if(this.name == key) {
						$(this).val(data.rows[rowIndex][key]);
					}
				}
			});

			$(form).find('select').each(function () {
				for (var key in data.rows[rowIndex]) {
					if (this.multiple) {
						if(this.name == key + '[]') {
							var select = this;
							$.each(data.rows[rowIndex][key].split(','), function(i, e) {
								$(select).children('option').each(function() {
									if(this.value == e) {
										$(this).prop('selected', 'true');
									}
								});
							});
						}
					}else{
						if(this.name == key) {
							$(this).val(data.rows[rowIndex][key]);
						}
					}
				}
			});

			$(form).find('input[type=checkbox]').each(function () {
				for (var key in data.rows[rowIndex]) {
					if(this.name == key && this.value == data.rows[rowIndex][key]) {
						$(this).prop("checked", true);
					}
				}
			});

			$(form).find('input[type=radio]').each(function () {
				for (var key in data.rows[rowIndex]) {
					if(this.name == key && this.value == data.rows[rowIndex][key]) {
						$(this).prop("checked", true);
					}
				}
			});
		}

		// Main function
	    this.run = function() {

			// Create the table parts
			BuildTableSection();

			// View merged cells if the mergecells array is defined
			if (config.mergeCells.length > 0) {
				PrintMergeCells();
			}

			// View regular column header table
			PrintNormalCells();

			// Sort data
			SortData();

			// Display data
			DisplayData(config.activePageNumber, config.itemsPerPage, SearchInput());

			// Option paging
			OptionPaging();

			// Search
			Search();
		}

	    return this;

	};

}( jQuery ));