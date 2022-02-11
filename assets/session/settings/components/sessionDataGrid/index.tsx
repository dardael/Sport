import React from "react";
import {DataGrid, GridColDef, GridRowsProp} from "@mui/x-data-grid";

const SessionDataGrid:React.FunctionComponent<{}> = ({}) => {
    const rows: GridRowsProp = [
        { id: 1, exercice: '', unit: '',  description:''},
    ];
    const columns: GridColDef[] = [
        { field: 'exercice', headerName: 'Exercice', width: 150 },
        { field: 'unit', headerName: 'Unité', width: 150 },
        { field: 'description', headerName: 'Description', flex: 1},
    ];
    return <>
        <DataGrid rows={rows} columns={columns} />
    </>
}

export default SessionDataGrid;
