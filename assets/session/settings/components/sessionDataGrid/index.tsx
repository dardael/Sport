import React, {useState} from "react";
import {
    DataGrid,
    GridColDef,
    GridRenderCellParams,
    renderActionsCell,
    GridActionsCellItem,
    GridValueFormatterParams
} from "@mui/x-data-grid";
import DeleteIcon from '@mui/icons-material/Delete';
import {
    Button,
    FormControl,
    InputBase,
    makeStyles,
    MenuItem,
    Select,
    SelectChangeEvent,
    TextField
} from "@mui/material";
import Session from "../../../entities/Session";

const SessionDataGrid:React.FunctionComponent<{initialSessions?: Session[]}> = ({initialSessions}) => {
    const [sessions, setSessions] = useState(initialSessions ? initialSessions : [new Session(1, '', 'rep', '')]);

    const updateSession = (newSessionProperty): void => {
        let currentSessions = [...sessions];
        let currentSession = {...getSession(newSessionProperty.id)} as Session;
        let sessionIndex = currentSessions.findIndex((session) => session.id === newSessionProperty.id);
        currentSession[newSessionProperty.field] =newSessionProperty.value;
        currentSessions[sessionIndex] = currentSession;
        setSessions(currentSessions);
    }

    const addSession = (): void => {
        let currentSessions = [...sessions];
        currentSessions.push(getNewSession())
        setSessions(currentSessions);
    }

    const deleteSession = (sessionId): void => {
        let currentSessions = [...sessions];
        let sessionIndex = currentSessions.findIndex((session) => session.id === sessionId);
        currentSessions.splice(sessionIndex, 1);
        setSessions(currentSessions);
    }

    const getSession = (sessionId: number): Session => {
        return sessions.find((session:Session) => session.id === sessionId);
    };

    const getNewSession = (): Session => {
        return new Session(getNewSessionId(), '', 'rep', '');
    }

    const getNewSessionId = (): number => {
        return sessions.length > 0
            ? (Math.max.apply(Math, sessions.map((session) => session.id)) + 1)
            : 1;
    }

    const columns = [
        {field: 'exercice', headerName: 'Exercice', width: 150, editable: true},
        {field: 'unit', headerName: 'Unité', width: 150, editable: true, type:'singleSelect', valueOptions:[
            {value:'rep', label:'Repetition'},
            {value:'min', label:'Minute'},
            {value:'sec', label:'Seconde'},
        ], valueFormatter: (sessionUnit: GridValueFormatterParams) => {
            switch (sessionUnit.value) {
                case 'rep':
                    return 'Repetition';
                case 'min':
                    return 'Minute';
                case 'sec':
                    return 'Seconde';
                default :
                    return '';
            }
        }},
        {field: 'description', headerName: 'Description', flex: 1, editable: true},
        {field: 'actions', type: 'actions', getActions: (session) => [
            <GridActionsCellItem
                icon={<DeleteIcon />}
                label="Delete"
                onClick={(() => deleteSession(session.id))}
            />
        ]},
    ];
    return <>
        <DataGrid
            hideFooter
            autoHeight
            rows={sessions}
            columns={columns}
            onCellEditCommit={updateSession}/>
        <Button variant="outlined" fullWidth onClick={addSession}>
            Ajouter un exercice
        </Button>
    </>
}

export default SessionDataGrid;
