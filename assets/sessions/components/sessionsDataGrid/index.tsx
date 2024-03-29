import React, {useState} from "react";
import {
    DataGrid,
    GridActionsCellItem
} from "@mui/x-data-grid";
import DeleteIcon from '@mui/icons-material/Delete';
import {Button} from "@mui/material";
import Session from "../entities/Session";
import SessionType from "../../../settings/sessions/entities/Session"

const SessionsDataGrid: React.FunctionComponent<{
    initialSessions?: Session[],
    sessionTypes: SessionType[]
}> = ({
     initialSessions,
     sessionTypes
 }) => {
    const [sessions, setSessions] = useState(initialSessions && initialSessions.length > 0
        ? initialSessions
        : []);

    const saveSessions = async (sessions) => {
        let formData = new FormData();
        sessions.forEach((session:Session, index:number) => {
            let sessionKey = 'sessions[' + index + ']';
            formData.append(sessionKey + '[id]', String(session.id));
            formData.append(sessionKey + '[sessionTypeId]', String(session.sessionTypeId));
            formData.append(sessionKey + '[value]', String(session.value));
            formData.append(
                sessionKey + '[date]',
                session.date ? session.date.toString() : ''
            );
        })
        await fetch(
            '/sessions/save',
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
        currentSession[newSessionProperty.field] = newSessionProperty.value;
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
        return new Session(getNewSessionId(), null, 0, null);
    }

    const getNewSessionId = (): number => {
        return sessions.length > 0
            ? (Math.max.apply(Math, sessions.map((session) => session.id)) + 1)
            : 1;
    }

    const getSessionTypeUnit = (sessionTypeId: number): string => {
        const session = sessionTypes.find((sessionType: SessionType) => sessionTypeId === sessionType.id)
        return session ? session.unit : '';
    }

    const columns = [
        {field: 'date', headerName: 'Date', editable: true, type:'dateTime', flex: 1,  minWidth: 10},
        {
            field: 'sessionTypeId',
            headerName: 'Exercice',
            editable: true,
            type: 'singleSelect',
            valueOptions:
                sessionTypes.map((sessionType) => {
                    return {value: sessionType.id, label: sessionType.exercice}
                }),
            valueGetter: (param) => {
                if (!param.row.sessionTypeId) {
                    return ''
                }
                const currentType = sessionTypes.find((sessionType) => sessionType.id === param.row.sessionTypeId);
                return currentType.exercice;
            },
            flex: 1,
            minWidth: 10        },
        {field: 'value', headerName: 'Valeur', editable: true, type:'number', flex: 1,  minWidth: 10},
        {
            field: 'unit', headerName: 'Unité', type: 'string', flex: 1, minWidth: 10, valueGetter: (param) => {
                switch (param.row.unit) {
                    case 'rep':
                        return 'Repetition';
                    case 'min':
                        return 'Minute';
                    case 'sec':
                        return 'Seconde';
                    default :
                        return '';
                }
            }
        }, {
            field: 'actions', type: 'actions', getActions: (session) => [
                <GridActionsCellItem
                    icon={<DeleteIcon/>}
                    label="Delete"
                    onClick={(() => deleteSession(session.id))}
                />
            ],
            flex: 1
        },
    ];

    return <>
        <div style={{ display: 'flex', height: '100%' }}>
            <div style={{ flexGrow: 1 }}>
                <DataGrid
                    hideFooter
                    autoHeight
                    rows={sessions.map((session) => {
                        return {
                            id:session.id,
                            date:session.date ? new Date(session.date) : null,
                            sessionTypeId:session.sessionTypeId,
                            value:session.value,
                            unit:getSessionTypeUnit(session.sessionTypeId),
                        }
                    })}
                    columns={columns}
                    onCellEditCommit={updateSession}
                />
                <Button variant="outlined" fullWidth onClick={addSession}>
                    Ajouter un exercice
                </Button>
            </div>
        </div>

    </>
}

export default SessionsDataGrid;
