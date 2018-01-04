HHVM_DEFINE_EXTENSION("vsdebug"
  SOURCES
    breakpoint.cpp
    command_queue.cpp
    command.cpp
    configuration_done_command.cpp
    continue_command.cpp
    debugger.cpp
    ext_vsdebug.cpp
    fdtransport.cpp
    hook.cpp
    initialize_command.cpp
    launch_attach_command.cpp
    logging.cpp
    session.cpp
    socket_transport.cpp
    transport.cpp
  HEADERS
    break_mode.h
    breakpoint.h
    client_preferences.h
    command_queue.h
    command.h
    debugger.h
    ext_vsdebug.h
    fdtransport.h
    hook.h
    logging.h
    session.h
    socket_transport.h
    transport.h
  DEPENDS
    libFolly
)
