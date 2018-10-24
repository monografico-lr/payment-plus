<template>
    <div class="bootstrap-table">
        <el-table
            ref="singleTable"
            :data="data"
            highlight-current-row
            @current-change="handleCurrentChange"
            style="width: 100%">
            <el-table-column 
                v-for="col in cols"
                :key="col.field"
                :type="col.type"
                :label="col.title"
                :property="col.field">
            </el-table-column>
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
      }
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
    mounted() {
        this.getData();
    },
    methods: {
      getData(page = 1) {
        page = page || this.pagination.page;
        const pageSize = this.pagination.pageSize || 50;

        this.$http.get(`${this.options.endpoint}?page=${page}&limit=${pageSize}`)
          .then((res) => {
            this.data = res.data.data;
            this.pagination.page = res.data.current_page;
            this.pagination.lastPage = res.data.last_page;
            this.pagination.pageSize = Number(res.data.per_page);
            this.pagination.total = res.data.total;
          });
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
      }
    }
}
</script>
