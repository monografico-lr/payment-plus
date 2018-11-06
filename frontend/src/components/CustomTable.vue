<template>
    <div class="bootstrap-table">
        <el-table
            ref="singleTable"
            :data="data"
            :stripe="true"
            highlight-current-row
            @current-change="handleCurrentChange"
            header-row-class-name="insane-table__header"
            style="width: 100%">
            <template v-for="(col, colIndex) in cols">
                <el-table-column
                    v-if="!col.customDisplay"
                    :key="`${col.field}-${colIndex}`"
                    :type="col.type"
                    :index="index"
                    :label="col.title"
                    :property="col.field">
                </el-table-column>

                <el-table-column v-if="col.customDisplay"
                    :key="`${col.field}-${colIndex}`"
                    :type="col.type"
                    :label="col.title"
                    :property="col.field">
                    <div  slot-scope="scope"  v-html="getHTMLText(scope.row, scope.column, col)">

                    </div>
                </el-table-column>
            </template>

        </el-table>

        <div class="block">
            <el-pagination
                @size-change="pageSizeChanged"
                @current-change="paginate"
                :current-page.sync="pagination.page"
                :page-sizes="options.pageList"
                :page-size="pagination.pageSize"
                layout="total, sizes, prev, pager, next"
                :total="pagination.total">
            </el-pagination>
        </div>
    </div>
</template>

<script>
export default {
    name: 'custom-table',
    props: {
      cols: {
        type: Array
      },
      options: {
        type: Object
      },
      ids: {
        type: String
      },
      parentId: {
        type: String
      },
      toolbar: {
        type: String
      },
      search: String
    },
    data() {
        return {
            currentRow: null,
            data: [],
            pagination: {
                page: 1,
                lastPage: 0,
                pageSize: this.options.pageSize,
                total: 0
            }
        }
    },
    watch: {
      search() {
        this.customSearch();
      },
      'options.endpoint'() {
        this.getData();
      }
    },
    mounted() {
        this.getData();
    },
    methods: {
      getData(page = 1, query) {
        if (this.options.endpoint) {
          page = page || this.pagination.page;
          const pageSize = this.pagination.pageSize || 50;
          const search = query ? `search=${query}&` : '';

          this.$http.get(`${this.options.endpoint}?${search}page=${page}&limit=${pageSize}`)
            .then((res) => {
              this.data = res.data.data;
              this.pagination.page = res.data.current_page;
              this.pagination.lastPage = res.data.last_page;
              this.pagination.pageSize = Number(res.data.per_page);
              this.pagination.total = res.data.total;
            });
        }
      },

      handleCurrentChange(val) {
        this.currentRow = val;
      },
      pageSizeChanged(pageSize) {
        this.pagination.pageSize = pageSize;
        this.getData();
      },
      paginate(page) {
        this.pagination.page = page;
        this.getData(page);
      },

      customSearch() {
        this.getData(1, this.search)
      },

      index(index) {
        index += 1;
        return this.pagination.page * this.pagination.pageSize - this.pagination.pageSize + index;
      },

        getHTMLText(row, field, cell) {
            const fieldValue =  row[cell.field]

            if (cell.customDisplay) {
                return cell.customDisplay(row, fieldValue, cell);
            } else if (cell.status) {
                let status = cell.statusCodes[row[cell.field]];
                if (!status) {
                    status = {
                        label: 'N/D',
                        class: 'primary'
                    }
                }
                return `<label class="label label-${status.class}"> ${status.label} </label>`
            } else {
                return `${field}`
            }
        },
    }
}
</script>

<style lang="sass">
@import './../insanecode/css/1-base/_index.sass'
.insane-table__header
  th
    background-color: $contrast-color !important
    color: #fff

.table-foot,
.fixed-table-pagination
  +makeFlex(100%,row,flex-end,center)
  height: 50px
  background: #fff
  border: 1px solid #ddd
  border-top: none
  color: #888
  padding: 0 15px
  .next-page,.previous-page
    font-size: 30px
    cursor: pointer
    &:hover
      color: $contrast-color
  .max-limit
    display: none
.pagination-labels
  +makeFlex(500px,row, center,center)
  div
    margin: 0 10px
  margin-right: 50px
.pagination-controlls
  width: 200px
.table
  th
    height: 42px
    border-right: 1px solid white
    background-position: right
    background-repeat: no-repeat
    padding-right: 30px
    cursor: pointer
    &:last-child
      border-radius: 0 4px 0 0
      border-right: none
    &:first-child
      border-radius: 4px 0 0 0
  tbody
    max-height: 220px
    width: 100%
    overflow: auto
    display: none
    tr
      cursor: pointer
      background: #fdfdfd
      color: #555
      font-weight: bolder
      &:nth-child(2n)
        background: #fff
      &:first-child
        box-shadow: inset 0 3px 4px rgba(0,0,0,.2)
      &:hover
        background: transparentize(#888,.7)
      &.selected
        background: lighten($contrast-color,25)
        color: #555
        border: 2px solid white
        border-left: none
        border-right: none
        td
          border-color: transparent
        &:hover
          color: #555
      &.marked
        background: lighten(#1FD1A8,40%)
        color: #222
        border: 2px solid white
        border-left: none
        border-right: none
      &.cancel
        background: lighten(#dF0a00,50%)
        color: #222
        border: 2px solid white
        border-left: none
        border-right: none

.total-table
  tbody
    display: table-row-group

  .bg-white
    background: white
    color: $primary-color

.table-hover>tbody>tr.marked:hover
  background-color: lighten(#1FD1A8,20%)

.table-hover>tbody>tr.cancel:hover
  background-color: lighten(#dF0a00,40%)

.fixed-table-container tbody .selected td
  background: lighten($contrast-color,25)
  color: #555

.pagination-detail
  .dropdown-toggle
    width: fit-content
    height: fit-content

.payment-delete
  color: transparentize($contrast-color,.7)
  transition: all ease .3s

  &:hover
    color: $color_error

ul.pagination
  margin: 0 0 0 0
  li
    display: none
    &:first-child,
    &:last-child
      display: inline-block
      float: none
      border: none
      font-size: 30px
      height: 28px
      border: none
      background: transparent
    a
      border: none
      float: none
      color: #888
      font-size: 30px
      cursor: pointer
      &:hover
        color: $contrast-color
        background: transparent
.table
  tbody td
    border-right: 1px solid #ddd
    vertical-align: middle

    &:last-child
      border-right: none
    &.done
      color: darken(#1FD1A8,10%)
    &.error
      color: lighten(#dF0a00,10%)
    &.mora
      color: #5C6BC0
    &.suspendido
      color: #FFC107
    &.exonerado
      color: lighten($primary-color,10%)
    &.en-corte
      color: lighten(#f44336,20%)
    i.material-icons
      height: 100%
      vertical-align: middle
    &.abono
      color: #f30
      text-transform: capitalize
      &:hover
        background-color: #f30
        color: white
.table>tbody>tr>td
  padding-top: 15px

.table.caja
  thead tr
    background: $primary-color
  tfoot tr
    background: white

  // Cards
.card-title
  +size(100%,48px)
  padding: 6px 0 0 0
  margin: 0 0 10px 0
  border-radius: 4px 4px 0 0
  box-shadow: 0 2px 3px rgba(0,0,0,.2)

// horas

.seconds
  color: #999


.mylists
  .table
    border: none
    margin-top: 0
    thead
      height: 58px
      tr
        background: $primary-color
        color: #fff
    tbody tr
      &:first-child
        box-shadow: none

.modal
  .table
    thead tr
      background: white
      color: $contrast-color


.innertable,
.mylist .innertable,
  margin-left: 0
  margin-right: 0
  margin-top: 0
  width: 100%

</style>

