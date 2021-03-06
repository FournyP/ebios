import React from "react";
import PropTypes from "prop-types";
import {
  Table as MaterialTable,
  TableHead,
  TableBody,
  TableContainer,
  TableRow,
  TableCell,
} from "@material-ui/core";
import { useTable } from "react-table";
import { Link } from "react-router-dom";

function Table(props) {
  const columns = props.columns;
  const data = props.data;

  const tableInstance = useTable({
    columns,
    data,
  });

  const { getTableProps, getTableBodyProps, headerGroups, rows, prepareRow } =
    tableInstance;

  return (
    <div>
      <TableContainer>
        <MaterialTable {...getTableProps()} fullwidth="true">
          <TableHead>
            {headerGroups.map((headerGroup) => (
              <TableRow {...headerGroup.getHeaderGroupProps()}>
                {headerGroup.headers.map((column) => (
                  <TableCell {...column.getHeaderProps()}>
                    {column.render("Header")}
                  </TableCell>
                ))}
              </TableRow>
            ))}
          </TableHead>
          <TableBody {...getTableBodyProps()}>
            {rows.map((row) => {
              prepareRow(row);
              return (
                  <TableRow {...row.getRowProps()} component={Link} to={"/project/" + row.values.id}>
                    {row.cells.map((cell) => {
                      return (
                        <TableCell {...cell.getCellProps()}>
                          {cell.render("Cell")}
                        </TableCell>
                      );
                    })}
                  </TableRow>
              );
            })}
          </TableBody>
        </MaterialTable>
      </TableContainer>
    </div>
  );
}

Table.propTypes = {
  columns: PropTypes.array,
  data: PropTypes.array,
};

export default Table;
