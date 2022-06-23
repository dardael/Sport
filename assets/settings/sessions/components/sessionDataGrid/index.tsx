import React, {useState} from "react";
import {
    DataGrid,
    GridActionsCellItem,
    GridValueFormatterParams
} from "@mui/x-data-grid";
import DeleteIcon from '@mui/icons-material/Delete';
import {Button} from "@mui/material";
import Session from "../../entities/Session";

const SessionDataGrid:React.FunctionComponent<{initialSessions?: Session[]}> = ({initialSessions}) => {
    const [sessions, setSessions] = useState(initialSessions && initialSessions.length > 0
        ? initialSessions
        : [new Session(1, '', 'rep', '')]);

    const saveSessions = async (sessions) => {
        let formData = new FormData();
        sessions.forEach((session) => {
            let sessionKey = 'sessions[' + session.id + ']';
            formData.append(sessionKey + '[id]', session.id);
            formData.append(sessionKey + '[exercice]', session.exercice);
            formData.append(sessionKey + '[unit]', session.unit);
            formData.append(sessionKey + '[description]', session.description);
        })
        await fetch(
            '/settings/sessions/save',
            {
                method: 'POST',
                body: formData,
            }
        );
    };

    const updateSession = (newSessionProperty): void => {
        let currentSessions = [...sessions];
        let currentSession = {...getSession(newSessionProperty.id)} as Session;
        let sessionIndex = currentSessions.findIndex((session) => session.id === newSessionProperty.id);
        currentSession[newSessionProperty.field] =newSessionProperty.value;
        currentSessions[sessionIndex] = currentSession;
        saveSessions(currentSessions);
        setSessions(currentSessions);
    }

    const addSession = (): void => {
        let currentSessions = [...sessions];
        currentSessions.push(getNewSession())
        saveSessions(currentSessions);
        setSessions(currentSessions);
    }

    const deleteSession = (sessionId): void => {
        let currentSessions = [...sessions];
        let sessionIndex = currentSessions.findIndex((session) => session.id === sessionId);
        currentSessions.splice(sessionIndex, 1);
        saveSessions(currentSessions);
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
