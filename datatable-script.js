// datatable-script.js
class DataTable {
    constructor(selector, options) {
        this.table = $(selector);
        this.options = options;
        this.data = [];
        this.filteredData = [];
        this.currentPage = 1;
        this.entriesPerPage = 10;
        this.sortColumn = 'index';
        this.sortOrder = 'asc';

        this.init();
    }

    init() {
        this.createControls();
        this.loadData();
        this.bindEvents();
    }

    createControls() {
        this.searchInput = this.table.closest('.datatable-container').find('.datatable-search');
        this.entriesSelect = this.table.closest('.datatable-container').find('.datatable-entries');
        this.pagination = this.table.closest('.datatable-container').find('.datatable-pagination');
    }

    loadData() {
        $.ajax({
            url: this.options.ajaxUrl,
            type: 'GET',
            data: this.options.ajaxParams,
            dataType: 'json',
            success: (response) => {
                if (response.data && Array.isArray(response.data)) {
                    this.data = response.data.map((item, index) => ({
                        ...item,
                        index: index + 1
                    }));
                    this.renderTable();
                } else {
                    this.showError('No data found');
                }
            },
            error: (xhr, status, error) => {
                console.error("Error:", error);
                this.showError('Error loading data');
            }
        });
    }

    bindEvents() {
        this.searchInput.on('input', () => {
            this.currentPage = 1;
            this.renderTable();
        });

        this.entriesSelect.on('change', () => {
            this.entriesPerPage = parseInt(this.entriesSelect.val());
            this.currentPage = 1;
            this.renderTable();
        });

        this.table.on('click', 'th', (e) => {
            let newSortColumn = $(e.currentTarget).data('sort');
            if (newSortColumn) {
                if (this.sortColumn === newSortColumn) {
                    this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
                } else {
                    this.sortColumn = newSortColumn;
                    this.sortOrder = 'asc';
                }
                this.renderTable();
            }
        });

        this.pagination.on('click', 'button', (e) => {
            let action = $(e.currentTarget).data('action');
            if (action === 'prev' && this.currentPage > 1) {
                this.currentPage--;
            } else if (action === 'next' && this.currentPage < this.getTotalPages()) {
                this.currentPage++;
            }
            this.renderTable();
        });
    }

    renderTable() {
        this.filteredData = this.filterData();
        let sortedData = this.sortData();
        let paginatedData = this.paginateData(sortedData);

        let tbody = this.table.find('tbody');
        tbody.empty();

        paginatedData.forEach((item) => {
            let row = '<tr>';
            this.options.columns.forEach((column) => {
                if (column.render) {
                    row += `<td>${column.render(item[column.data], item)}</td>`;
                } else {
                    row += `<td>${item[column.data]}</td>`;
                }
            });
            row += '</tr>';
            tbody.append(row);
        });

        this.updateSortIcons();
        this.renderPagination();
    }

    filterData() {
        let searchTerm = this.searchInput.val().toLowerCase();
        return this.data.filter(item => 
            Object.values(item).some(value => 
                value.toString().toLowerCase().includes(searchTerm)
            )
        );
    }

    sortData() {
        return this.filteredData.sort((a, b) => {
            if (a[this.sortColumn] < b[this.sortColumn]) return this.sortOrder === 'asc' ? -1 : 1;
            if (a[this.sortColumn] > b[this.sortColumn]) return this.sortOrder === 'asc' ? 1 : -1;
            return 0;
        });
    }

    paginateData(data) {
        let start = (this.currentPage - 1) * this.entriesPerPage;
        let end = start + this.entriesPerPage;
        return data.slice(start, end);
    }

    updateSortIcons() {
        this.table.find('th').removeClass('sort-asc sort-desc');
        this.table.find(`th[data-sort="${this.sortColumn}"]`).addClass(`sort-${this.sortOrder}`);
    }

    renderPagination() {
        let totalPages = this.getTotalPages();
        this.pagination.empty();

        if (totalPages > 1) {
            this.pagination.append(`
                <button data-action="prev" ${this.currentPage === 1 ? 'disabled' : ''}>Previous</button>
                <span>Page ${this.currentPage} of ${totalPages}</span>
                <button data-action="next" ${this.currentPage === totalPages ? 'disabled' : ''}>Next</button>
            `);
        }
    }

    getTotalPages() {
        return Math.ceil(this.filteredData.length / this.entriesPerPage);
    }

    showError(message) {
        this.table.find('tbody').html(`<tr><td colspan="${this.options.columns.length}">${message}</td></tr>`);
    }
}