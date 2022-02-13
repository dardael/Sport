import React, {useState} from "react";
import {DataGrid, GridColDef, GridRenderCellParams, renderActionsCell, GridActionsCellItem} from "@mui/x-data-grid";
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

    const renderExerciceCell = (sessionExercice: GridRenderCellParams<string>) => {
        return <InputBase
            id={'session-unit-' + sessionExercice.id}
            fullWidth
            placeholder={'Deeps, Pompes, ...'}
            value={sessionExercice.value}
            onChange={(event: React.ChangeEvent<HTMLInputElement>) => {
                updateSession({id: Number(sessionExercice.id), exercice: event.target.value});
            }}
        />
    };

    const renderDescriptionCell = (sessionDescription: GridRenderCellParams<string>) => {
        return <InputBase
            id={'session-unit-' + sessionDescription.id}
            fullWidth
            placeholder={"Description de l'exercice"}
            value={sessionDescription.value}
            onChange={(event: React.ChangeEvent<HTMLInputElement>) => {
                updateSession({id: Number(sessionDescription.id), description: event.target.value});
            }}
        />
    };

    const renderUnitCell = (sessionUnit: GridRenderCellParams<string>) => {
        return <FormControl variant="standard">
            <Select
                id={'session-unit-' + sessionUnit.id}
                value={sessionUnit.value}
                onChange={(event: SelectChangeEvent) => {
                    updateSession({id: Number(sessionUnit.id), unit: event.target.value});
                }}
                autoWidth
                disableUnderline={true}
            >
                <MenuItem value='rep'>Repetition</MenuItem>
                <MenuItem value='min'>Minute</MenuItem>
                <MenuItem value='sec'>Seconde</MenuItem>
            </Select>
        </FormControl>
    };

    const updateSession = (newSession?): void => {
        let currentSessions = [...sessions];
        if (!newSession) {
            currentSessions.push(getNewSession())
            setSessions(currentSessions);
            return;
        }
        let currentSession = {...getSession(newSession.id)} as Session;
        let sessionIndex = currentSessions.findIndex((session) => session.id === newSession.id);
        currentSession.unit = newSession.unit || currentSession.unit;
        currentSession.description = newSession.description || currentSession.description;
        currentSession.exercice = newSession.exercice || currentSession.exercice;
        currentSessions[sessionIndex] = currentSession;
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
        return (Math.max.apply(Math, sessions.map(function (session) {
            return session.id;
        })) || 0) + 1;
    }

    const columns = [
        {field: 'exercice', headerName: 'Exercice', width: 150, editable: true, renderCell: renderExerciceCell},
        {field: 'unit', headerName: 'Unité', width: 150, editable: true, renderCell: renderUnitCell},
        {field: 'description', headerName: 'Description', flex: 1, editable: true, renderCell: renderDescriptionCell},
        {field: 'actions', type: 'actions', getActions: () => [
            <GridActionsCellItem
                icon={<DeleteIcon />}
                label="Delete"
                onClick={(session =>deleteSession(session.id))}
            />
        ]},
    ];
    return <>
        <DataGrid editMode="row" hideFooter autoHeight rows={sessions} columns={columns} />
        <Button variant="outlined" fullWidth onClick={() => updateSession()}>
            Ajouter un exercice
        </Button>
    </>
}

export default SessionDataGrid;
